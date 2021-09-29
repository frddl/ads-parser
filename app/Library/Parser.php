<?php

namespace App\Library;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use voku\helper\HtmlDomParser;

class Parser
{
    public $ads = [];
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getAds()
    {
        $client = new Client();

        $request = new Request('GET', $this->config['start_path']);
        $promise = $client->sendAsync($request)->then(function ($response) {
            $html = $response->getBody()->getContents();

            $dom = HtmlDomParser::str_get_html($html);

            foreach ($dom->find($this->config['ad_selector']) as $product) {
                $ad = [];
                foreach ($this->config['properties'] as $name => $properties) {
                    $ad[$name] = $product->find($properties['selector'], 0)->{$properties['attribute']};
                }

                array_push($this->ads, $ad);
            }
        });

        $promise->wait();
    }
}
