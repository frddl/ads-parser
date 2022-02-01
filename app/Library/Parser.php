<?php

namespace App\Library;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use voku\helper\HtmlDomParser;
use Illuminate\Support\Str;

class Parser
{
    public $ads = [];
    private $config;
    private $currency_variations = [];
    private $start_url;

    public function __construct($config, $start_url = null)
    {
        $this->config = $config;
        $this->currency_variations = config('parsers.currency_variations');
        $this->start_url = $start_url;
    }

    public function getAds()
    {
        $client = new Client();
        $url =  $this->config['start_path'];
        if ($this->start_url) $url = $this->start_url;

        $ua = new UserAgent();
        $request = new Request('GET', $url, [
            'headers' => [
                'User-Agent' => $ua->string(),
            ]
        ]);

        $promise = $client->sendAsync($request)->then(function ($response) {
            $html = $response->getBody()->getContents();

            $dom = HtmlDomParser::str_get_html($html);

            foreach ($dom->find($this->config['ad_selector']) as $product) {
                $ad = [];
                foreach ($this->config['properties'] as $name => $properties) {
                    $ad[$name] = strip_tags($product->find($properties['selector'], 0)->{$properties['attribute']});
                }

                if ($this->config['convert_currency'] && isset($ad['price'])) {
                    $currencyContainingString = strip_tags($product->find($this->config['currency_selector'], 0));
                    foreach ($this->currency_variations as $variation) {
                        if (preg_match('/' . implode("|", $variation['matches']) . '/i', strtolower($currencyContainingString))) {
                            $converter = new CurrencyConverter($variation['multiplier']);
                            $ad['price'] = $converter->amount($ad['price']);
                            break;
                        }
                    }
                }

                foreach ($this->config['notification'] as $name => $properties) {
                    $ad['notification_' . $name] = strip_tags($product->find($properties['selector'], 0)->{$properties['attribute']});
                }

                // eliminating external links
                if (!(Str::contains($ad['link'], 'http:') || Str::contains($ad['link'], 'https:'))) array_push($this->ads, $ad);
            }
        });

        $promise->wait();
    }
}
