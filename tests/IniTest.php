<?php

declare(strict_types=1);

namespace PHLAK\Config\Tests;

use PHLAK\Config\Loaders\Ini;
use PHLAK\Config\Tests\Traits\Initializable;
use PHPUnit\Framework\Attributes\CoversClass;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[CoversClass(Ini::class)]
class IniTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/ini/config.ini';
        $this->invalidConfig = __DIR__ . '/files/ini/invalid.ini';
    }
}
