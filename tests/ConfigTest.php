<?php

use Config\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    /** @var Config\Config Instance of Config\Config */
    protected $config;

    public function setUp()
    {
        $this->config = new Config();
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
        $config = new Config();

        $config->set('driver', 'sqlite');
        $config->load(__DIR__ . '/files/php/config.php');

        $this->assertEquals('mysql', $config->get('driver'));
    }

    public function test_it_can_load_additional_files_without_overriding_existing_options()
    {
        $config = new Config();

        $config->set('driver', 'sqlite');
        $config->load(__DIR__ . '/files/php/config.php', false);

        $this->assertEquals('sqlite', $config->get('driver'));
    }

    public function test_it_can_merge_a_config_object()
    {
        $config = new Config(['foo' => 'foo', 'baz' => 'baz']);
        $gifnoc = new Config(['bar' => 'rab', 'baz' =>'zab']);

        $config->merge($gifnoc);

        $this->assertEquals('foo', $config->get('foo'));
        $this->assertEquals('rab', $config->get('bar'));
        $this->assertEquals('zab', $config->get('baz'));
    }

    public function test_it_can_split_into_a_sub_object()
    {
        $config = new Config([
            'foo' => 'foo',
            'bar' => [
                'baz' => 'barbaz'
            ]
        ]);

        $bar = $config->split('bar');

        $this->assertEquals('barbaz', $bar->get('baz'));
        $this->assertNull($bar->get('foo'));
    }

    public function test_it_throws_an_exception_when_initialized_with_an_invalid_context()
    {
        $this->setExpectedException('Config\Exceptions\InvalidContextException');

        new Config(123);
    }
}
