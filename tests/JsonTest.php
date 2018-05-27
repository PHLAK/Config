<?php

use PHLAK\Config;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{
    use Initializable;

    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/json/config.json';
        $this->invalidConfig = __DIR__ . '/files/json/invalid.json';
    }
}
