<?php

namespace App\Library;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use voku\helper\HtmlDomParser;

class Parser
{
    public $ads = [];
    private $config;
    private $start_url;

    public function __construct($config, $start_url = null)
    {
        $this->config = $config;
        $this->start_url = $start_url;
    }

    public function getAds()
    {
        $client = new Client();
        $url =  $this->config['start_path'];
        if ($this->start_url) $url = $this->start_url;

        $request = new Request('GET', $url);
        $promise = $client->sendAsync($request)->then(function ($response) {
            $html = $response->getBody()->getContents();

            $dom = HtmlDomParser::str_get_html($html);

            foreach ($dom->find($this->config['ad_selector']) as $product) {
                $ad = [];
                foreach ($this->config['properties'] as $name => $properties) {
                    $ad[$name] = strip_tags($product->find($properties['selector'], 0)->{$properties['attribute']});
                }

                array_push($this->ads, $ad);
            }
        });

        $promise->wait();
    }
}
