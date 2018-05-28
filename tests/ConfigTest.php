<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config;
use PHLAK\Config\Exceptions\InvalidContextException;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function test_it_can_set_and_retrieve_an_item()
    {
        $config = new Config\Config();

        $this->assertTrue($config->set('name', 'John Pinkerton'));
        $this->assertEquals('John Pinkerton', $config->get('name'));
    }

    public function test_it_can_set_and_retrieve_an_item_by_dot_notation()
    {
        $config = new Config\Config();

        $this->assertTrue($config->set('foo.bar.baz', 'foo-bar-baz'));
        $this->assertEquals('foo-bar-baz', $config->get('foo.bar.baz'));
        $this->assertEquals(['baz' => 'foo-bar-baz'], $config->get('foo.bar'));
    }

    public function test_it_returns_null_for_nonexistant_items()
    {
        $config = new Config\Config();

        $this->assertNull($config->get('nonexistant-item'));
    }

    public function test_it_returns_a_default_value_for_nonexistant_items()
    {
        $config = new Config\Config();

        $this->assertFalse($config->get('nonexistant-item', false));
    }

    public function test_it_returns_true_if_it_has_an_item()
    {
        $config = new Config\Config(['has' => 'some-item']);

        $this->assertTrue($config->has('has'));
    }

    public function test_it_returns_true_if_it_has_a_boolean_false()
    {
        $config = new Config\Config(['false' => false]);

        $this->assertTrue($config->has('false'));
    }

    public function test_it_returns_false_if_it_doesnt_have_an_item()
    {
        $config = new Config\Config();

        $this->assertFalse($config->has('nonexistant-item'));
    }

    public function test_it_returns_true_if_it_has_an_item_by_dot_notation()
    {
        $config = new Config\Config(['foo' => ['bar' => 'foobar']]);

        $this->assertTrue($config->has('foo.bar'));
    }

    public function test_it_can_load_and_read_additional_files()
    {
        $config = new Config\Config(['driver' => 'sqlite']);

        $config->load(__DIR__ . '/files/php/config.php');

        $this->assertEquals('mysql', $config->get('driver'));
    }

    public function test_it_can_load_additonal_files_with_a_prefix()
    {
        $config = new Config\Config();

        $config->load(__DIR__ . '/files/php/config.php', 'database');

        $this->assertEquals('mysql', $config->get('database.driver'));
    }

    public function test_it_can_load_additional_files_without_overriding_existing_options()
    {
        $config = new Config\Config(['driver' => 'sqlite']);

        $config->load(__DIR__ . '/files/php/config.php', null, false);

        $this->assertEquals('sqlite', $config->get('driver'));
    }

    public function test_it_can_merge_a_config_object()
    {
        $config = new Config\Config(['foo' => 'foo', 'baz' => 'baz']);
        $gifnoc = new Config\Config(['bar' => 'rab', 'baz' => 'zab']);

        $config->merge($gifnoc);

        $this->assertEquals('foo', $config->get('foo'));
        $this->assertEquals('rab', $config->get('bar'));
        $this->assertEquals('zab', $config->get('baz'));
    }

    public function test_it_can_split_into_a_sub_object()
    {
        $config = new Config\Config([
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
        $this->expectException(InvalidContextException::class);

        new Config\Config(123);
    }

    public function test_it_can_set_and_retrieve_a_closure()
    {
        $config = new Config\Config();

        $config->set('closure', function ($foo) {
            return ucwords($foo);
        });

        $closure = $config->get('closure');

        $this->assertInstanceOf(\Closure::class, $closure);
        $this->assertEquals('John Pinkerton', $closure('john pinkerton'));
    }

    public function test_it_can_be_handled_like_an_array()
    {
        $config = new Config\Config(['foo' => 'foo', 'bar' => 'bar']);
        $config['baz'] = 'baz';
        unset($config['bar']);

        $this->assertTrue(isset($config['foo']));
        $this->assertFalse(isset($config['bar']));
        $this->assertEquals('foo', $config['foo']);
        $this->assertEquals('baz', $config['baz']);
    }

    public function test_it_can_be_returned_as_an_array()
    {
        $config = new Config\Config([
            'foo' => 'foo',
            'bar' => [
                'baz' => 'barbaz'
            ]
        ]);

        $this->assertEquals([
            'foo' => 'foo',
            'bar' => [
                'baz' => 'barbaz'
            ]
        ], $config->toArray());
    }

    public function test_it_is_foreachable()
    {
        $config = new Config\Config([
            'foo' => true,
            'bar' => true,
            'baz' => true
        ]);

        $this->assertTrue(is_iterable($config));

        foreach ($config as $item) {
            $this->assertTrue($item);
        }
    }
}
