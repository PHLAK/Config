<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config\Config;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[\PHPUnit\Framework\Attributes\CoversClass(\PHLAK\Config\Loaders\Directory::class)]
class DirectoryTest extends TestCase
{
    public function test_it_can_initialize_a_directory(): void
    {
        $config = new Config(__DIR__ . '/files');

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('mysql', $config->get('driver'));
    }

    public function test_it_can_initialize_an_array_with_a_prefix(): void
    {
        $config = new Config(__DIR__ . '/files', 'database');

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('mysql', $config->get('database.driver'));
    }
}
