<?php

use PHLAK\Config;

class IniTest extends PHPUnit_Framework_TestCase
{
    use Initializable;

    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/ini/config.ini';
        $this->invalidConfig = __DIR__ . '/files/ini/invalid.ini';
    }
}
