<?php

namespace App\ParseStrategy;

class TurboAz implements parseStrategy
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->config = config('parsers.sites.turbo_az');
    }

    public function parse()
    {
    }

    public function generateAdUrl(): string
    {
        return '';
    }
}
