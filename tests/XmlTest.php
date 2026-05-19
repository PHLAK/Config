<?php

declare(strict_types=1);

namespace PHLAK\Config\Tests;

use PHLAK\Config\Tests\Traits\Initializable;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[\PHPUnit\Framework\Attributes\CoversClass(\PHLAK\Config\Loaders\Xml::class)]
class XmlTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/xml/config.xml';
        $this->invalidConfig = __DIR__ . '/files/xml/invalid.xml';
    }
}
