<?php

namespace Typomedia\Ini\Service;

/**
 * Class Mapper
 * @package Typomedia\Ini\Service
 */
class Mapper
{
    public const BOOLEAN_TRUE  = ['true', 'on', 'yes', '1'];
    public const BOOLEAN_FALSE = ['false', 'off', 'no', '0'];

    public static function convert($value)
    {
        if (in_array(strtolower($value), self::BOOLEAN_TRUE)) {
            return true;
        }

        if (in_array(strtolower($value), self::BOOLEAN_FALSE)) {
            return false;
        }

        return (string) $value;
    }
}
