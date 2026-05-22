<?php

declare(strict_types=1);

namespace PHLAK\Config\Tests;

use PHLAK\Config\Loaders\Php;
use PHLAK\Config\Tests\Traits\Initializable;
use PHPUnit\Framework\Attributes\CoversClass;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[CoversClass(Php::class)]
class PhpTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/php/config.php';
        $this->invalidConfig = __DIR__ . '/files/php/invalid.php';
    }
}
