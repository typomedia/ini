<?php

namespace Typomedia\Tests\Ini;

use Matomo\Ini\IniReader;
use Matomo\Ini\IniReadingException;
use PHPUnit\Framework\TestCase;
use Laminas\Config\Reader\Ini;

/**
 * Class ParserTest
 * @package Typomedia\Tests\Ini
 */
class CompareTest extends TestCase
{
    /**
     * @throws IniReadingException
     */
    public function testMatomoIni()
    {
        $file = __DIR__ . '/Fixtures/Beer.ini';

        $expected = include('Fixtures/Beer.php');

        $reader = new IniReader();
        $actual = $reader->readFile($file);

        $this->assertEquals($expected, $actual);
    }

    public function testZendIni()
    {
        $file = __DIR__ . '/Fixtures/Beer.ini';

        $expected = include('Fixtures/Beer.php');

        $reader = new Ini();
        $actual = $reader->fromFile($file);

        $this->assertEquals($expected, $actual);
    }
}
