<?php

use Config\Config;

class JsonTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/json/config.json';
        $this->invalidConfig = __DIR__ . '/files/json/invalid.json';
    }

    use Initializable;
}
