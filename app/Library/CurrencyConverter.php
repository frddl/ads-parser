<?php

namespace App\Library;

class CurrencyConverter
{
    private $multiplier;

    public function __construct($multiplier = 1)
    {
        $this->multiplier = $multiplier;
    }

    public function amount($amount): string
    {
        return $this->toReadableString(ceil(numeric($amount) * $this->multiplier));
    }

    private function toReadableString($number): string
    {
        // reverse the string
        $reversed = strrev(strval($number));

        // chunk into parts of 3 digits and put in array
        $chunked_arr = str_split($reversed, 3);

        // build a string back using a space separator
        $imploded = implode(" ", $chunked_arr);

        // reverse back the string
        $reversed_back = strrev($imploded);

        // add current currency
        $result = $reversed_back . " " . config('parsers.currency_string');
        return $result;
    }
}
