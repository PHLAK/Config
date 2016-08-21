<?php

class ConfigTest extends PHPUnit_Framework_TestCase
{
    /** @var Config\Config Instance of Config\Config */
    protected $config;

    public function setUp()
    {
        $this->config = Config\Factory::init();
    }

    public function test_it_can_initialize_an_array()
    {
        $this->assertInstanceOf('Config\Config', Config\Factory::init([
            'foo' => ['bar' => 'foobar']
        ]));
    }

    public function test_it_can_initialize_a_php_file()
    {
        $path = __DIR__ . '/files/config.php';
        $this->assertInstanceOf('Config\Config', Config\Factory::init($path));
    }

    public function test_it_can_initialize_an_ini_file()
    {
        $path = __DIR__ . '/files/config.ini';
        $this->assertInstanceOf('Config\Config', Config\Factory::init($path));
    }

    public function test_it_can_initialize_a_json_file()
    {
        $path = __DIR__ . '/files/config.json';
        $this->assertInstanceOf('Config\Config', Config\Factory::init($path));
    }

    public function test_it_can_initialize_a_directory()
    {
        $path = __DIR__ . '/files';
        $this->assertInstanceOf('Config\Config', Config\Factory::init($path));
    }

    public function test_it_can_set_and_retrieve_an_item()
    {
        $this->assertTrue($this->config->set('name', 'John Pinkerton'));
        $this->assertEquals('John Pinkerton', $this->config->get('name'));
    }

    public function test_it_can_set_and_retrieve_an_item_by_dot_notation()
    {
        $this->assertTrue($this->config->set('foo.bar.baz', 'foo-bar-baz'));
        $this->assertEquals('foo-bar-baz', $this->config->get('foo.bar.baz'));
        $this->assertEquals(['baz' => 'foo-bar-baz'], $this->config->get('foo.bar'));
    }

    public function test_it_returns_null_for_nonexistant_items()
    {
        $this->assertNull($this->config->get('nonexistant-item'));
    }

    public function test_it_returns_a_default_value_for_nonexistant_items()
    {
        $this->assertFalse($this->config->get('nonexistant-item', false));
    }

    public function test_it_returns_true_if_it_has_an_item()
    {
        $this->config->set('has', 'some-item');
        $this->assertTrue($this->config->has('has'));
    }

    public function test_it_returns_true_if_it_has_a_boolean_false()
    {
        $this->config->set('false', false);
        $this->assertTrue($this->config->has('false'));
    }

    public function test_it_returns_false_if_it_doesnt_have_an_item()
    {
        $this->assertFalse($this->config->has('nonexistant-item'));
    }

    public function test_it_returns_true_if_it_has_an_item_by_dot_notation()
    {
        $this->config->set('foo.bar', 'foobar');
        $this->assertTrue($this->config->has('foo.bar'));
    }

    public function test_it_can_load_and_read_additional_files()
    {
        $this->assertNotFalse($this->config->load(__DIR__ . '/files/config.php'));
        $this->assertEquals('Dade', $this->config->get('name.first'));
    }
}
