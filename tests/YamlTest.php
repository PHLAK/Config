<?php

declare(strict_types=1);

namespace PHLAK\Config\Tests;

use PHLAK\Config\Config;
use PHLAK\Config\Exceptions\InvalidFileException;
use PHLAK\Config\Loaders\Yaml;
use PHLAK\Config\Tests\Traits\Initializable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[CoversClass(Yaml::class)]
class YamlTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/yaml/config.yaml';
        $this->invalidConfig = __DIR__ . '/files/yaml/invalid.yaml';
    }

    #[Test]
    public function it_throws_an_exception_when_initializing_a_yaml_file_without_an_array(): void
    {
        $this->expectException(InvalidFileException::class);

        new Config(__DIR__ . '/files/yaml/bad.yaml');
    }

    #[Test]
    public function it_can_initialize_a_file_with_an_alternate_extension(): void
    {
        $config = new Config(__DIR__ . '/files/yaml/config.yml');

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('database.sqlite', $config->get('drivers.sqlite.database'));
    }
}
