<?php

use Config\Config;

class PhpTest extends PHPUnit_Framework_TestCase
{
    /** @var string Path to a valid config file */
    protected $validConfig = __DIR__ . '/files/php/config.php';

    /** @var string Path to an invalid config file */
    protected $invalidConfig = __DIR__ . '/files/php/invalid.php';

    use Initializable;
}
