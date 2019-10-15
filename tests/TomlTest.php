<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config\Config;
use PHLAK\Config\Exceptions\InvalidFileException;
use PHLAK\Config\Tests\Traits\Initializable;
use PHPUnit\Framework\TestCase;

class TomlTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/toml/config.toml';
        $this->invalidConfig = __DIR__ . '/files/toml/invalid.toml';
    }

    public function test_it_throws_an_exception_when_initializing_a_toml_file_without_an_array()
    {
        $this->expectException(InvalidFileException::class);

        new Config(__DIR__ . '/files/toml/bad.toml');
    }
}
