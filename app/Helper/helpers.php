<?php

use Illuminate\Support\Str;

if (!function_exists('snake_keys')) {
    function snake_keys($array, $delimiter = '_')
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = snake_keys($value, $delimiter);
            }
            $result[snake_case($key, $delimiter)] = $value;
        }
        return $result;
    }
}

if (!function_exists('snake_case')) {
    /**
     * Convert a string to snake case.
     *
     * @param  string  $value
     * @param  string  $delimiter
     * @return string
     */
    function snake_case($value, $delimiter = '_')
    {
        return Str::snake($value, $delimiter);
    }
}
