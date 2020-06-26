<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config\Tests\Traits\Initializable;
use PHPUnit\Framework\TestCase;

/** @covers \PHLAK\Config\Loaders\Xml */
class XmlTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/xml/config.xml';
        $this->invalidConfig = __DIR__ . '/files/xml/invalid.xml';
    }
}
