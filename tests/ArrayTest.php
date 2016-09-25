<?php

use Config\Config;

class ArrayTest extends PHPUnit_Framework_TestCase
{
    public function test_it_can_initialize_an_array()
    {
        $config = new Config(['foo' => ['bar' => 'foobar']]);

        $this->assertInstanceOf('Config\Config', $config);
        $this->assertEquals('foobar', $config->get('foo.bar'));
    }
}
