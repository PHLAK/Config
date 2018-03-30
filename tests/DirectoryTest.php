<?php

use PHLAK\Config;

class DirectoryTest extends PHPUnit_Framework_TestCase
{
    public function test_it_can_initialize_a_directory()
    {
        $config = new Config\Config(__DIR__ . '/files');

        $this->assertInstanceOf(Config\Config::class, $config);
        $this->assertEquals('mysql', $config->get('driver'));
    }

    public function test_it_can_initialize_an_array_with_a_prefix()
    {
        $config = new Config\Config(__DIR__ . '/files', 'database');

        $this->assertInstanceOf(Config\Config::class, $config);
        $this->assertEquals('mysql', $config->get('database.driver'));
    }
}
