<?php

namespace Typomedia\Ini;

use Typomedia\Ini\Service\Encoder;
use Typomedia\Ini\Exception\DumperException;

/**
 * Class Dumper
 * @package Typomedia\Ini
 */
class Dumper implements DumperInterface
{
    /**
     * @var string
     */
    protected $ini;

    /**
     * @param array $config
     * @return string
     * @throws DumperException
     */
    public function dump(array $config = [])
    {
        foreach ($config as $name => $sections) {
            if (!is_array($sections)) {
                throw new DumperException($name);
            }

            $this->ini .= '[' . $name . ']' . PHP_EOL;

            foreach ($sections as $property => $item) {
                if (is_array($item)) {
                    foreach ($item as $key => $value) {
                        $key = is_int($key) ? '[]' : '[' . Encoder::sanitize($key) . ']';
                        $this->ini .= $property . $key . ' = ' . Encoder::normalize($value) . PHP_EOL;
                    }
                } else {
                    $this->ini .= $property . ' = ' . Encoder::normalize($item) . PHP_EOL;
                }
            }
        }

        return $this->ini;
    }
}
