<?php

use Config\Config;

trait Initializable
{
    /** @var string Path to a valid config file */
    protected $validConfig;

    /** @var string Path to an invalid config file */
    protected $invalidConfig;

    public function test_it_can_initialize_a_file()
    {
        $config = new Config($this->validConfig);

        $this->assertInstanceOf('Config\Config', $config);
        $this->assertEquals('database.sqlite', $config->get('drivers.sqlite.database'));
    }

    public function test_it_throws_an_exception_when_initializing_an_invalid_file()
    {
        $this->setExpectedException('Config\Exceptions\InvalidFileException');

        new Config($this->invalidConfig);
    }
}
