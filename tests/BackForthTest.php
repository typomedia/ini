<?php

namespace Typomedia\Tests\Ini;

use PHPUnit\Framework\TestCase;
use Typomedia\Ini\Dumper;
use Typomedia\Ini\Parser;
use Typomedia\Ini\Exception\DumperException;

/**
 * Class BackForthTest
 * @package Typomedia\Tests\Ini
 */
class BackForthTest extends TestCase
{
    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @var Dumper
     */
    protected $dumper;

    protected function setUp(): void
    {
        $this->parser = new Parser();
        $this->dumper = new Dumper();
    }

    /**
     * @throws DumperException
     */
    public function testDumpAndParse()
    {
        $config = ['Melville' => ['Moby' => 'Dick'], 'Cervantes' => ['Don' => 'Quijote']];

        $ini = $this->dumper->dump($config);
        $config = $this->parser->parse($ini);

        $this->assertEquals(['Moby' => 'Dick'], $config['Melville']);
        $this->assertEquals('Quijote', $config['Cervantes']['Don']);
    }

    /**
     * @throws DumperException
     */
    public function testParseAndDump()
    {
        $file = file_get_contents('tests/Fixtures/Database.ini');
        $expected = $this->parser->parse($file);

        $ini = $this->dumper->dump($expected);
        $actual = $this->parser->parse($ini);

        $this->assertEquals($expected, $actual);
    }
}
