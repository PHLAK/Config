<?php

use PHLAK\Config;

class YamlTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/yaml/config.yaml';
        $this->invalidConfig = __DIR__ . '/files/yaml/invalid.yaml';
    }

    use Initializable;

    public function test_it_throws_an_exception_when_initializing_a_yaml_file_without_an_array()
    {
        $this->setExpectedException(Config\Exceptions\InvalidFileException::class);

        new Config\Config(__DIR__ . '/files/yaml/bad.yaml');
    }
}
