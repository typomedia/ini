<?php

namespace Typomedia\Ini\Service;

/**
 * Class Typer
 * @package Typomedia\Ini\Service
 */
class Typer
{
    public static function cast($value)
    {
        switch (true) {
            case is_bool($value):
                return (bool) $value;
            case is_int($value):
                return (int) $value;
            case is_float($value):
                return (float) $value;
            case is_string($value):
                return Mapper::convert($value);
            case is_array($value):
                return (array) $value;
            case is_null($value):
                return null;
            default:
                return $value;
        }
    }
}
