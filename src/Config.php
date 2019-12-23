<?php

namespace PHLAK\Config;

use ArrayAccess;
use DirectoryIterator;
use IteratorAggregate;
use PHLAK\Config\Exceptions\InvalidContextException;
use PHLAK\Config\Traits\Arrayable;
use RuntimeException;
use SplFileInfo;

class Config implements ArrayAccess, IteratorAggregate
{
    use Arrayable;

    /** @var array Array of configuration options */
    protected $config = [];

    /**
     * Create a new Config object.
     *
     * @param mixed  $context Raw array of configuration options or path to a
     *                        configuration file or directory containing one or
     *                        more configuration files
     * @param string $prefix  A key under which the loaded config will be nested
     */
    public function __construct($context = null, $prefix = null)
    {
        switch (gettype($context)) {
            case 'NULL':
                break;
            case 'array':
                $this->config = $prefix ? [$prefix => $context] : $context;
                break;
            case 'string':
                $this->load($context, $prefix);
                break;
            default:
                throw new InvalidContextException('Failed to initialize config');
        }
    }

    /**
     * Create a new Config object from a directory with prefixed entries by file.
     *
     * @param string $path path to a directory containing one or more
     *                     configuration files
     *
     * @return static A new Config object
     */
    public static function createFromDirectory(string $path)
    {
        $config = new static();

        foreach (new DirectoryIterator($path) as $file) {
            if ($file->isFile()) {
                $config->load(
                    $file->getRealPath(),
                    pathinfo($file->getBasename(), PATHINFO_FILENAME)
                );
            }
        }

        return $config;
    }

    /**
     * Store a config value with a specified key.
     *
     * @param string $key   Unique configuration option key
     * @param mixed  $value Config item value
     *
     * @return bool True on success, otherwise false
     */
    public function set($key, $value)
    {
        $config = &$this->config;

        foreach (explode('.', $key) as $k) {
            $config = &$config[$k];
        }

        $config = $value;

        return true;
    }

    /**
     * Retrieve a configuration option via a provided key.
     *
     * @param string $key     Unique configuration option key
     * @param mixed  $default Default value to return if option does not exist
     *
     * @return mixed Stored config item or $default value
     */
    public function get($key, $default = null)
    {
        $config = $this->config;

        foreach (explode('.', $key) as $k) {
            if (! isset($config[$k])) {
                return $default;
            }
            $config = $config[$k];
        }

        return $config;
    }

    /**
     * Check for the existence of a configuration item.
     *
     * @param string $key Unique configuration option key
     *
     * @return bool True if item existst, otherwise false
     */
    public function has($key)
    {
        $config = $this->config;

        foreach (explode('.', $key) as $k) {
            if (! isset($config[$k])) {
                return false;
            }
            $config = $config[$k];
        }

        return true;
    }

    /**
     * Append a value onto an existing array configuration option.
     *
     * @param string $key   Unique configuration option key
     * @param mixed  $value Config item value
     *
     * @throws RuntimeException
     *
     * @return true
     */
    public function append($key, $value)
    {
        $config = &$this->config;

        foreach (explode('.', $key) as $k) {
            $config = &$config[$k];
        }

        if (! is_array($config)) {
            throw new RuntimeException("Config item '{$key}' is not an array");
        }

        $config = array_merge($config, (array) $value);

        return true;
    }

    /**
     * Prepend a value onto an existing array configuration option.
     *
     * @param string $key   Unique configuration option key
     * @param mixed  $value Config item value
     *
     * @throws RuntimeException
     *
     * @return true
     */
    public function prepend($key, $value)
    {
        $config = &$this->config;

        foreach (explode('.', $key) as $k) {
            $config = &$config[$k];
        }

        if (! is_array($config)) {
            throw new RuntimeException("Config item '{$key}' is not an array");
        }

        $config = array_merge((array) $value, $config);

        return true;
    }

    /**
     * Load configuration options from a file or directory.
     *
     * @param string $path     Path to configuration file or directory
     * @param string $prefix   A key under which the loaded config will be nested
     * @param bool   $override Whether or not to override existing options with
     *                         values from the loaded file
     *
     * @return self This Config object
     */
    public function load($path, $prefix = null, $override = true)
    {
        $file = new SplFileInfo($path);

        $className = $file->isDir() ? 'Directory' : ucfirst(strtolower($file->getExtension()));
        $classPath = 'PHLAK\\Config\\Loaders\\' . $className;

        $loader = new $classPath($file->getRealPath());

        $newConfig = $prefix ? [$prefix => $loader->getArray()] : $loader->getArray();

        if ($override) {
            $this->config = array_replace_recursive($this->config, $newConfig);
        } else {
            $this->config = array_replace_recursive($newConfig, $this->config);
        }

        return $this;
    }

    /**
     * Merge another Config object into this one.
     *
     * @param Config $config   Instance of Config
     * @param bool   $override Whether or not to override existing options with
     *                         values from the merged config object
     *
     * @return self This Config object
     */
    public function merge(self $config, $override = true)
    {
        if ($override) {
            $this->config = array_replace_recursive($this->config, $config->toArray());
        } else {
            $this->config = array_replace_recursive($config->toArray(), $this->config);
        }

        return $this;
    }

    /**
     * Split a sub-array of configuration options into it's own Config object.
     *
     * @param string $key Unique configuration option key
     *
     * @return Config A new Config object
     */
    public function split($key)
    {
        return new static($this->get($key));
    }

    /**
     * Return the entire configuration as an array.
     *
     * @return array The configuration array
     */
    public function toArray()
    {
        return $this->config;
    }
}
