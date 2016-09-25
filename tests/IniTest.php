<?php

use Config\Config;

class IniTest extends PHPUnit_Framework_TestCase
{
    /** @var string Path to a valid config file */
    protected $validConfig = __DIR__ . '/files/ini/config.ini';

    /** @var string Path to an invalid config file */
    protected $invalidConfig = __DIR__ . '/files/ini/invalid.ini';

    use Initializable;
}
