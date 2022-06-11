<?php

namespace App\Library;

use Illuminate\Support\Arr;

class UserAgent
{
    private $config = [];

    public function __construct()
    {
        $this->config = config('user-agents');
    }

    public function string()
    {
        $browser = Arr::random(array_keys($this->config));
        $uas = $this->config[$browser];

        return Arr::random($uas);
    }
}
