<?php

namespace Typomedia\Tests\Ini;

use PHPUnit\Framework\TestCase;
use Typomedia\Ini\Dumper;
use Typomedia\Ini\Exception\DumperException;

/**
 * Class DumperTest
 * @package Typomedia\Tests\Ini
 */
class DumperTest extends TestCase
{
    /**
     * @var Dumper
     */
    protected $dumper;

    protected function setUp(): void
    {
        $this->dumper = new Dumper();
    }

    /**
     * @throws DumperException
     */
    public function testDumpNumericArray()
    {
        $expected = file_get_contents('tests/Fixtures/Beer.ini');

        $config = include('Fixtures/Beer.php');
        $actual = $this->dumper->dump($config);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws DumperException
     */
    public function testDumpNestedArray()
    {
        $expected = file_get_contents('tests/Fixtures/Database.ini');

        $config = include('Fixtures/Database.php');
        $actual = $this->dumper->dump($config);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws DumperException
     */
    public function testDumpEmptyArray()
    {
        $this->assertEquals('', $this->dumper->dump([]));
    }

    /**
     * @throws DumperException
     */
    public function testDumpInvalidConfig()
    {
        $this->expectExceptionMessage('Section');
        $this->dumper->dump(['Section' => 1234]);
    }

    public function testDumpComplexJson()
    {
        $file = file_get_contents('tests/Fixtures/Complex.json');
        $json = json_decode($file, true);

        $actual = $this->dumper->dump($json);

        $expected = file_get_contents('tests/Fixtures/Complex.ini');
        $this->assertEquals($expected, $actual);
    }
}
