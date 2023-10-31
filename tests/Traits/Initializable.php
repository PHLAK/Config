<?php

namespace PHLAK\Config\Tests\Traits;

use PHLAK\Config\Config;
use PHLAK\Config\Exceptions\ConfigException;
use PHLAK\Config\Exceptions\InvalidFileException;

trait Initializable
{
    /** @var string Path to a valid config file */
    protected $validConfig;

    /** @var string Path to an invalid config file */
    protected $invalidConfig;

    public function test_it_can_initialize_a_file(): void
    {
        $config = new Config($this->validConfig);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('database.sqlite', $config->get('drivers.sqlite.database'));
    }

    public function test_it_throws_an_exception_when_initializing_an_invalid_file(): void
    {
        $this->expectException(ConfigException::class);
        $this->expectException(InvalidFileException::class);

        new Config($this->invalidConfig);
    }

    public function test_it_can_initialize_a_file_with_a_prefix(): void
    {
        $config = new Config($this->validConfig, 'database');

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('database.sqlite', $config->get('database.drivers.sqlite.database'));
    }
}
