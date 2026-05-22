<?php

declare(strict_types=1);

namespace PHLAK\Config\Tests\Traits;

use PHLAK\Config\Config;
use PHLAK\Config\Exceptions\ConfigException;
use PHLAK\Config\Exceptions\InvalidFileException;
use PHPUnit\Framework\Attributes\Test;

trait Initializable
{
    /** @var string Path to a valid config file */
    protected $validConfig;

    /** @var string Path to an invalid config file */
    protected $invalidConfig;

    #[Test]
    public function it_can_initialize_a_file(): void
    {
        $config = new Config($this->validConfig);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('database.sqlite', $config->get('drivers.sqlite.database'));
    }

    #[Test]
    public function it_throws_an_exception_when_initializing_an_invalid_file(): void
    {
        $this->expectException(ConfigException::class);
        $this->expectException(InvalidFileException::class);

        new Config($this->invalidConfig);
    }

    #[Test]
    public function it_can_initialize_a_file_with_a_prefix(): void
    {
        $config = new Config($this->validConfig, 'database');

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('database.sqlite', $config->get('database.drivers.sqlite.database'));
    }
}
