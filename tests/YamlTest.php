<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config\Config;
use PHLAK\Config\Exceptions\InvalidFileException;
use PHLAK\Config\Tests\Traits\Initializable;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/** @covers \PHLAK\Config\Loaders\Yaml */
class YamlTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/yaml/config.yaml';
        $this->invalidConfig = __DIR__ . '/files/yaml/invalid.yaml';
    }

    public function test_it_throws_an_exception_when_initializing_a_yaml_file_without_an_array()
    {
        $this->expectException(InvalidFileException::class);

        new Config(__DIR__ . '/files/yaml/bad.yaml');
    }
}
