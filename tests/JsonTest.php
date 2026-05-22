<?php

declare(strict_types=1);

namespace PHLAK\Config\Tests;

use PHLAK\Config\Loaders\Json;
use PHLAK\Config\Tests\Traits\Initializable;
use PHPUnit\Framework\Attributes\CoversClass;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[CoversClass(Json::class)]
class JsonTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/json/config.json';
        $this->invalidConfig = __DIR__ . '/files/json/invalid.json';
    }
}
