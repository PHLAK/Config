<?php

use PHLAK\Config;

class ArrayTest extends PHPUnit_Framework_TestCase
{
    public function test_it_can_initialize_an_array()
    {
        $config = new Config\Config(['foo' => ['bar' => 'foobar']]);

        $this->assertInstanceOf(Config\Config::class, $config);
        $this->assertEquals('foobar', $config->get('foo.bar'));
    }
}
