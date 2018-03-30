<?php

namespace PHLAK\Config;

use ArrayAccess;
use PHLAK\Config\Traits\Arrayable;
use PHLAK\Config\Exceptions\InvalidContextException;
use SplFileInfo;

class Config implements ArrayAccess
{
    use Arrayable;

    /** @var array Array of configuration options */
    protected $config = [];

    /**
     * Create a Config object.
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
     * Store a config value with a specified key.
     *
     * @param string $key   Unique configuration option key
     * @param mixed  $value Config item value
     *
     * @return object This Config object
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
     * Check for the existance of a config item.
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
     * @param Config $config Instance of Config
     *
     * @return self This Config object
     */
    public function merge(self $config)
    {
        $this->config = array_merge($this->config, $config->toArray());

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
