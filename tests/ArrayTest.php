<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config\Config;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/** @covers \PHLAK\Config\Traits\Arrayable */
class ArrayTest extends TestCase
{
    public function test_it_can_initialize_an_array(): void
    {
        $config = new Config(['foo' => ['bar' => 'foobar']]);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('foobar', $config->get('foo.bar'));
    }

    public function test_it_can_initialize_an_array_with_a_prefix(): void
    {
        $config = new Config(['foo' => ['bar' => 'foobar']], 'baz');

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('foobar', $config->get('baz.foo.bar'));
    }
}
