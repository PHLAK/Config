<?php

use PHLAK\Config;
use PHPUnit\Framework\TestCase;

class PhpTest extends TestCase
{
    use Initializable;

    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/php/config.php';
        $this->invalidConfig = __DIR__ . '/files/php/invalid.php';
    }
}
