<?php

declare(strict_types=1);

namespace PHLAK\Config\Tests;

use PHLAK\Config\Config;
use PHLAK\Config\Loaders\Directory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[CoversClass(Directory::class)]
class DirectoryTest extends TestCase
{
    #[Test]
    public function it_can_initialize_a_directory(): void
    {
        $config = new Config(__DIR__ . '/files');

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('mysql', $config->get('driver'));
    }

    #[Test]
    public function it_can_initialize_an_array_with_a_prefix(): void
    {
        $config = new Config(__DIR__ . '/files', 'database');

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('mysql', $config->get('database.driver'));
    }
}
