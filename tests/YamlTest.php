<?php

use Config\Config;

class YamlTest extends PHPUnit_Framework_TestCase
{
    /** @var string Path to a valid config file */
    protected $validConfig = __DIR__ . '/files/yaml/config.yaml';

    /** @var string Path to an invalid config file */
    protected $invalidConfig = __DIR__ . '/files/yaml/invalid.yaml';

    /** @var string Path to an bad config file */
    protected $badConfig = __DIR__ . '/files/yaml/bad.yaml';

    use Initializable;

    public function test_it_throws_an_exception_when_initializing_a_yaml_file_without_an_array()
    {
        $this->setExpectedException('Config\Exceptions\InvalidFileException');

        new Config($this->badConfig);
    }
}
