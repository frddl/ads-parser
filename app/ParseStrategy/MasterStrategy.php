<?php

namespace App\ParseStrategy;

use App\Library\Parser;

class MasterStrategy implements parseStrategy
{
    public $conf_path = '';

    private $data;
    private $config;

    public function __construct($data)
    {
        $this->data = $data;
        $this->config = config($this->conf_path);
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function parse(): array
    {
        $ads = [];

        $parser = new Parser($this->getConfig());
        $parser->getAds();

        if (count($parser->ads) > 0) {
            $ads = $parser->ads;
        }

        return $ads;
    }

    public function generateAdUrl(): string
    {
        return implode('', [
            $this->config['url'],
            $this->config['route_prefix'],
            $this->data['result_link']
        ]);
    }
}
