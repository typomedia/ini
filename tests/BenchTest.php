<?php

namespace Typomedia\Tests\Ini;

use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use Typomedia\Ini\Parser;

/**
 * Class BenchTest
 */
class BenchTest
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var false|string
     */
    private $ini;

    public function setUp()
    {
        $this->parser = new Parser();
        $this->ini = file_get_contents('tests/Fixtures/Database.ini');
    }

    /**
     * @BeforeMethods("setUp")
     * @Iterations(100)
     */
    public function benchNativeParser()
    {
        parse_ini_string($this->ini, true);
    }

    /**
     * @BeforeMethods("setUp")
     * @Iterations(100)
     */
    public function benchIniParser()
    {
        $this->parser->parse($this->ini);
    }
}