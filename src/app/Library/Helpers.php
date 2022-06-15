<?php

if (!function_exists('numeric')) {
    function numeric($input): int
    {
        return intval(preg_replace('/[^0-9]/', '', $input));
    }
}
