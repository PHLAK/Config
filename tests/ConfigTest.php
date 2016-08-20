<?php

class ConfigTest extends PHPUnit_Framework_TestCase
{
    /** @var Config\Config Instance of Config\Config */
    protected $config;

    public function setUp()
    {
        $this->config = new Config\Config();
    }

    public function test_it_can_initialize_a_php_file()
    {
        $path = __DIR__ . '/files/config.php';
        $this->assertInstanceOf('Config\Config', new Config\Config($path));
    }

    public function test_it_can_initialize_an_ini_file()
    {
        $path = __DIR__ . '/files/config.ini';
        $this->assertInstanceOf('Config\Config', new Config\Config($path));
    }

    public function test_it_can_initialize_a_json_file()
    {
        $path = __DIR__ . '/files/config.json';
        $this->assertInstanceOf('Config\Config', new Config\Config($path));
    }

    public function test_it_can_initialize_a_directory()
    {
        $path = __DIR__ . '/files';
        $this->assertInstanceOf('Config\Config', new Config\Config($path));
    }
}
