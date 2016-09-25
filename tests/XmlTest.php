<?php

use Config\Config;

class XmlTest extends PHPUnit_Framework_TestCase
{
    /** @var string Path to a valid config file */
    protected $validConfig = __DIR__ . '/files/xml/config.xml';

    /** @var string Path to an invalid config file */
    protected $invalidConfig = __DIR__ . '/files/xml/invalid.xml';

    use Initializable;
}
