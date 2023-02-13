<?php

use app\Core\Config\Config;

if (!function_exists('config')) {
    function config(string $key): array|string
    {
        return (new Config)->get($key);
    }
}
