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
     * @return mixed
     * @throws DumperException
     */
    public function dump(array $config = [])
    {
        $result = '';
        foreach ($config as $section => $item) {
            if (!is_array($item)) {
                throw new DumperException($section);
            }
            $result .= '[' . $section . ']' . PHP_EOL;
            $result .= $this->loop($item);
        }

        return $result;
    }

    protected function loop(array $array, string $parent = ''): string
    {
        $result = '';
        foreach ($array as $key => $value) {
            $key = Encoder::sanitize($key);
            $property = $parent ? $parent . '[' . $key . ']' : $key;

            if (is_array($value)) {
                $result .= $this->loop($value, $property);
            } else {
                $result .= $this->add($property, $value);
            }
        }

        return $result;
    }

    protected function add($property, $value)
    {
        return $property . ' = ' . Encoder::normalize($value) . PHP_EOL;
    }
}
