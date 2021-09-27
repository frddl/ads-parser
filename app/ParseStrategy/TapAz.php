<?php

namespace App\ParseStrategy;

class TapAz implements parseStrategy
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->config = config('parsers.sites.tap_az');
    }

    public function parse()
    {
    }

    public function generateAdUrl(): string
    {
        return '';
    }
}
