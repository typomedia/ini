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
        switch (true) {
            case is_bool($value):
                return (int) $value;
            case is_string($value):
                return '"' . $value . '"';
            case $value instanceof \DateTime:
                return '"' . $value->format('Y-m-d H:i:s') . '"';
            default:
                return $value;
        }
    }

    /**
     * @param $key
     * @return string|string[]|null
     */
    public static function sanitize($key)
    {
        return preg_replace('/[^A-Za-z0-9\-_]/', '', $key);
    }

    /**
     * @param $array
     * @param $value
     * @return array|mixed|null
     */
    public static function unflat($array, $value = null)
    {
        return $array ? [array_shift($array) => self::unflat($array, $value)] : $value;
    }
}
