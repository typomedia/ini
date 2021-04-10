<?php

namespace Typomedia\Ini;

/**
 * Interface DumperInterface
 * @package Typomedia\Ini
 */
interface DumperInterface
{
    /**
     * @param array $config
     * @return mixed
     */
    public function dump(array $config);
}
