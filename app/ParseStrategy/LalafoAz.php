<?php

namespace App\ParseStrategy;

class LalafoAz implements parseStrategy
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->config = config('parsers.sites.lalafo_az');
    }

    public function parse()
    {
    }

    public function generateAdUrl(): string
    {
        return '';
    }
}
