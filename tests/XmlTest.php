<?php

use PHLAK\Config;

class XmlTest extends PHPUnit_Framework_TestCase
{
    use Initializable;

    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/xml/config.xml';
        $this->invalidConfig = __DIR__ . '/files/xml/invalid.xml';
    }
}
