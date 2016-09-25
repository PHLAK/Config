<?php

use Config\Config;

class JsonTest extends PHPUnit_Framework_TestCase
{
    /** @var string Path to a valid config file */
    protected $validConfig = __DIR__ . '/files/json/config.json';

    /** @var string Path to an invalid config file */
    protected $invalidConfig = __DIR__ . '/files/json/invalid.json';

    use Initializable;
}
