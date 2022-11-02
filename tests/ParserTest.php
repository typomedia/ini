<?php

namespace Typomedia\Tests\Ini;

use Matomo\Ini\IniReader;
use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\ObjectSet;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Subject;
use PHPUnit\Framework\TestCase;
use Typomedia\Ini\Exception\DumperException;
use Typomedia\Ini\Parser;
use Laminas\Config\Reader\Ini;

/**
 * Class ParserTest
 * @package Typomedia\Tests\Ini
 */
class ParserTest extends TestCase
{
    /**
     * @Subject()
     * @Iterations(100)
     */
    public function testIniParserDatabase()
    {
        $file = __DIR__ . '/Fixtures/Database.ini';

        $expected = include('Fixtures/Database.php');

        $parser = new Parser();
        $actual = $parser->parse(file_get_contents($file));

        $this->assertEquals($expected, $actual);
    }

    /**
     * @Subject()
     * @Iterations(100)
     */
    public function testIniParserBeer()
    {
        $file = __DIR__ . '/Fixtures/Beer.ini';

        $expected = include('Fixtures/Beer.php');

        $parser = new Parser();
        $actual = $parser->parse(file_get_contents($file));

        $this->assertEquals($expected, $actual);
    }
}
