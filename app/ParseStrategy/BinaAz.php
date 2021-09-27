<?php

namespace App\ParseStrategy;

class BinaAz implements parseStrategy
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->config = config('parsers.sites.bina_az');
    }

    public function parse()
    {
    }

    public function generateAdUrl(): string
    {
        return '';
    }
}
