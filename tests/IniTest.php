<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config\Tests\Traits\Initializable;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[\PHPUnit\Framework\Attributes\CoversClass(\PHLAK\Config\Loaders\Ini::class)]
class IniTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/ini/config.ini';
        $this->invalidConfig = __DIR__ . '/files/ini/invalid.ini';
    }
}
