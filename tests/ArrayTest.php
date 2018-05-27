<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config;
use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{
    public function test_it_can_initialize_an_array()
    {
        $config = new Config\Config(['foo' => ['bar' => 'foobar']]);

        $this->assertInstanceOf(Config\Config::class, $config);
        $this->assertEquals('foobar', $config->get('foo.bar'));
    }

    public function test_it_can_initialize_an_array_with_a_prefix()
    {
        $config = new Config\Config(['foo' => ['bar' => 'foobar']], 'baz');

        $this->assertInstanceOf(Config\Config::class, $config);
        $this->assertEquals('foobar', $config->get('baz.foo.bar'));
    }
}
