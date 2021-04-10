<?php

namespace Typomedia\Ini;

/**
 * Interface ParserInterface
 * @package Typomedia\Ini
 */
interface ParserInterface
{
    /**
     * @param string $string
     * @return mixed
     */
    public function parse(string $string);
}
