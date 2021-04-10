<?php

namespace Typomedia\Ini\Service;

/**
 * Class Encoder
 * @package Typomedia\Ini\Service
 */
class Encoder
{
    /**
     * @param $value
     * @return int|string
     */
    public static function normalize($value)
    {
        if (is_bool($value)) {
            return (int) $value;
        }

        if (is_string($value)) {
            return '"' . $value . '"';
        }

        return $value;
    }

    /**
     * @param $key
     * @return string|string[]|null
     */
    public static function sanitize($key)
    {
        $key = preg_replace('/[^A-Za-z0-9\-_]/', '', $key);

        return $key;
    }
}
