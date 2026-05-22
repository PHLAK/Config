<?php

declare(strict_types=1);

namespace PHLAK\Config\Tests;

use PHLAK\Config\Loaders\Xml;
use PHLAK\Config\Tests\Traits\Initializable;
use PHPUnit\Framework\Attributes\CoversClass;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

#[CoversClass(Xml::class)]
class XmlTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/xml/config.xml';
        $this->invalidConfig = __DIR__ . '/files/xml/invalid.xml';
    }
}
