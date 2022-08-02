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
    if (!function_exists('jsonDecode')) {

        function jsonDecode($key, $data)
        {
            if (array_key_exists($key, $data)) {
                $jsonData = json_decode($data[$key]);
                $finalData = snake_keys($jsonData);
            } else {
                $finalData = null;
            }
            return $finalData;
        }
    }
    if (!function_exists('itemsPerPage')) {

        function itemsPerPage()
        {
            return 10;
        }
    }
}
