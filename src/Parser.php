<?php

namespace Typomedia\Ini;

use Typomedia\Ini\Service\Encoder;
use Typomedia\Ini\Service\Typer;

/**
 * Class Parser
 * @package Typomedia\Ini
 */
class Parser implements ParserInterface
{
    /**
     * @var array
     */
    protected $result = [];

    protected $section;

    protected $property;

    protected $nodes;

    /**
     * @param string $string
     * @return array|false|mixed|string
     */
    public function parse(string $string): array
    {
        unset($this->result);
        $string = str_replace(["\r\n", "\r"], "\n", $string);
        $lines = explode("\n", $string);

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line)) {
                // skip empty
                continue;
            }

            if (strpos($line, ';') === 0) {
                // skip comments
                continue;
            }

            $section = $this->getSection($line);
            if ($section) {
                $this->section = $section;
                $this->setSection();
            } elseif (strpos($line, '=') !== false) {
                [$key, $value] = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                $value = trim($value, '"');
                $value = trim($value, "'");
                $value = Typer::cast($value);

                if ($this->section === false) {
                    $this->result[$key] = $value;
                } elseif (is_array($this->result[$this->section])) {
                    // database[embedded]
                    $property = $this->getProperty($key);
                    $subkeys = $this->getSubkeys($line);
                    if ($subkeys) {
                        $array = Encoder::unflat($subkeys, $value);
                        $this->addNode($array);
                        $this->setNodes($property, $array);
                        //$this->insertProperty($property, $array);
                    } else {
                        $this->setProperty($property, $value);
                    }
                }
            }
        }

        return $this->result;
    }

    protected function setSection(): void
    {
        if (!isset($this->result[$this->section])) {
            $this->result[$this->section] = [];
        }
    }

    protected function setProperty(string $property, $value): void
    {
        $this->result[$this->section][$property] = $value;
    }

    protected function addNode($node)
    {
        if (is_array($node)) {
            $this->nodes = empty($this->nodes) ? $node : array_replace_recursive($this->nodes, $node);
        }
    }

    protected function setNodes(string $property, array $array): void
    {
        foreach ($array as $key => $value) {
            if (empty($key)) {
                $this->result[$this->section][$property][] = $value;
            } else {
                $this->result[$this->section][$property][$key] = $this->nodes[$key];
            }
        }
    }

    protected function getSection($string)
    {
        preg_match('/^\[(.+)]/', $string, $matches);
        return $matches[1] ?? false;
    }

    protected function getProperty($string)
    {
        preg_match('/^([\w|_]+)(\[.*])$/', $string, $matches);

        $result = $matches[1] ?? $string;

        if ($this->property !== $result) {
            unset($this->nodes);
        }

        $this->property = $result;
        return $this->property;
    }

    protected function getSubkeys($string)
    {
        preg_match_all('/\[(\w*)]/', $string, $keys);
        return $keys[1] ?? false;
    }
}
