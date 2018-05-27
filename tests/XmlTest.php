<?php

use PHLAK\Config;
use PHPUnit\Framework\TestCase;

class XmlTest extends TestCase
{
    use Initializable;

    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/xml/config.xml';
        $this->invalidConfig = __DIR__ . '/files/xml/invalid.xml';
    }
}
