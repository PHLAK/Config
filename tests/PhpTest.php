<?php

use PHLAK\Config;

class PhpTest extends PHPUnit_Framework_TestCase
{
    use Initializable;
    
    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/php/config.php';
        $this->invalidConfig = __DIR__ . '/files/php/invalid.php';
    }
}
