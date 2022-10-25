<?php

namespace Typomedia\Tests\Ini\Service;

use Typomedia\Ini\Service\Mapper;
use PHPUnit\Framework\TestCase;

class MapperTest extends TestCase
{
    public function dataTrue()
    {
        return [
            ['true'],
            ['on'],
            ['yes'],
            ['1'],
        ];
    }

    public function dataFalse()
    {
        return [
            ['false'],
            ['off'],
            ['no'],
            ['0'],
        ];
    }

    /**
     * @dataProvider dataTrue
     * @param string $type
     */
    public function testCaseTrue($type)
    {
        $actual = Mapper::convert($type);
        $this->assertEquals(true, $actual);
    }

    /**
     * @dataProvider dataFalse
     * @param string $type
     */
    public function testCaseFalse(string $type)
    {
        $actual = Mapper::convert($type);
        $this->assertEquals(false, $actual);
    }
}
