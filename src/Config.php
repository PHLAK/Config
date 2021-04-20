<?php

namespace PHLAK\Config;

use ArrayAccess;
use DirectoryIterator;
use IteratorAggregate;
use PHLAK\Config\Exceptions\InvalidContextException;
use PHLAK\Config\Interfaces\ConfigInterface;
use PHLAK\Config\Traits\Arrayable;
use RuntimeException;
use SplFileInfo;

class Config implements ConfigInterface, ArrayAccess, IteratorAggregate
{
    use Arrayable;

    /** @var array Array of configuration options */
    protected $config = [];

    /**
     * Create a new Config object.
     *
     * @param mixed $context Raw array of configuration options or path to a
     *                       configuration file or directory containing one or
     *                       more configuration files
     * @param string $prefix A key under which the loaded config will be nested
     */
    public function __construct($context = null, string $prefix = null)
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
     * @param string $path A path to a directory of configuration files
     *
     * @return \PHLAK\Config\Interfaces\ConfigInterface A new ConfigInterface object
     */
    public static function fromDirectory(string $path): ConfigInterface
    {
        $config = new self();

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
     * @param string $key Unique configuration option key
     * @param mixed $value Config item value
     *
     * @return bool True on success, otherwise false
     */
    public function set(string $key, $value): bool
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
     * @param string $key Unique configuration option key
     * @param mixed $default Default value to return if option does not exist
     *
     * @return mixed Stored config item or $default value
     */
    public function get(string $key, $default = null)
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
    public function has(string $key): bool
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
     * @param string $key Unique configuration option key
     * @param mixed $value Config item value
     *
     * @throws RuntimeException
     *
     * @return true
     */
    public function append(string $key, $value): bool
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
     * @param string $key Unique configuration option key
     * @param mixed $value Config item value
     *
     * @throws RuntimeException
     *
     * @return true
     */
    public function prepend(string $key, $value): bool
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
     * Unset a configuration option via a provided key.
     *
     * @param string $key Unique configuration option key
     *
     * @return bool True on success, otherwise false
     */
    public function unset(string $key): bool
    {
        if (! $this->has($key)) {
            return false;
        }

        return $this->set($key, null);
    }

    /**
     * Load configuration options from a file or directory.
     *
     * @param string $path Path to configuration file or directory
     * @param string $prefix A key under which the loaded config will be nested
     * @param bool $override Whether or not to override existing options with
     *                       values from the loaded file
     *
     * @return \PHLAK\Config\Interfaces\ConfigInterface This Config object
     */
    public function load(string $path, string $prefix = null, bool $override = true): ConfigInterface
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
     * @param \PHLAK\Config\Interfaces\ConfigInterface $config Instance of Config
     * @param bool $override Whether or not to override existing options with
     *                       values from the merged config object
     *
     * @return \PHLAK\Config\Interfaces\ConfigInterface This Config object
     */
    public function merge(ConfigInterface $config, bool $override = true): ConfigInterface
    {
        if ($override) {
            $this->config = array_replace_recursive($this->config, $config->toArray());
        } else {
            $this->config = array_replace_recursive($config->toArray(), $this->config);
        }

        return $this;
    }

    /**
     * Split a sub-array of configuration options into it's own config.
     *
     * @param string $key Unique configuration option key
     *
     * @return \PHLAK\Config\Interfaces\ConfigInterface A new ConfigInterface object
     */
    public function split(string $key): ConfigInterface
    {
        return new self($this->get($key));
    }

    /**
     * Return the entire configuration as an array.
     *
     * @return array The configuration array
     */
    public function toArray(): array
    {
        return $this->config;
    }
}
