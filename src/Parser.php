<?php

namespace Typomedia\Ini;

use RuntimeException;

/**
 * Class Parser
 * @package Typomedia\Ini
 */
class Parser implements ParserInterface
{
    /**
     * @var string
     */
    protected $result;

    /**
     * @param string $string
     * @return array|false|mixed|string
     */
    public function parse(string $string)
    {
        try {
            $this->result = parse_ini_string($string, true, INI_SCANNER_TYPED);
        } catch (RuntimeException $e) {
            $this->result = $e->getMessage();
        }

        return $this->result;
    }
}
