<?php

namespace App\Library;

use Illuminate\Support\Arr;

class Proxy
{
    private $config = [];

    public function __construct()
    {
        $this->config = config('proxies');
    }

    public function string()
    {
        return Arr::random($this->config);
    }
}
