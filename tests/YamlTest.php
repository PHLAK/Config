<?php

use PHLAK\Config;
use PHPUnit\Framework\TestCase;

class YamlTest extends TestCase
{
    use Initializable;

    public function setUp()
    {
        $this->validConfig = __DIR__ . '/files/yaml/config.yaml';
        $this->invalidConfig = __DIR__ . '/files/yaml/invalid.yaml';
    }

    /**
     * @expectedException PHLAK\Config\Exceptions\InvalidFileException
     */
    public function test_it_throws_an_exception_when_initializing_a_yaml_file_without_an_array()
    {
        new Config\Config(__DIR__ . '/files/yaml/bad.yaml');
    }
}
