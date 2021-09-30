<?php

namespace App\Library;

class UserAgent
{
    private $config = [];
    private $arr_keys = [];

    public function __construct()
    {
        $this->config = config('user-agents');
        $this->arr_keys = array_keys($this->config);
    }

    public function string()
    {
        $browser = $this->arr_keys[rand(0, count($this->arr_keys) - 1)];
        $uas = $this->config[$browser];

        $random_string = $uas[rand(0, count($uas) - 1)];
        return $random_string;
    }
}
