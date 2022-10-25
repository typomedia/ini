<?php

namespace Typomedia\Tests\Ini\Service;

use Typomedia\Ini\Service\Typer;
use PHPUnit\Framework\TestCase;

class TyperTest extends TestCase
{
    public function testCaseBoolean()
    {
        $actual = Typer::cast(true);
        $this->assertIsBool($actual);
    }

    public function testCaseString()
    {
        $actual = Typer::cast('string');
        $this->assertIsString($actual);
    }

    public function testCaseNull()
    {
        $actual = Typer::cast(null);
        $this->assertNull($actual);
    }

    public function testCaseFloat()
    {
        $actual = Typer::cast(1.1);
        $this->assertIsFloat($actual);
    }

    public function testCaseInteger()
    {
        $actual = Typer::cast(10);
        $this->assertIsInt($actual);
    }

    public function testCaseArray()
    {
        $actual = Typer::cast(['a', 'b', 'c']);
        $this->assertIsArray($actual);
    }

    public function testCaseObject()
    {
        $actual = Typer::cast(new Typer());
        $this->assertIsObject($actual);
    }
}
