<?php

namespace Config;

use Config\Exceptions\InvalidContextException;
use SplFileInfo;

class Config
{
    /** @var array Array of configuration options */
    protected $config = [];

    /**
     * Class constructor, runs on object creation
     *
     * @param  mixed $context Raw array of configuration options or path to a
     *                        configuration file or directory
     */
    public function __construct($context = null)
    {
        switch (gettype($context)) {
            case 'NULL': break;
            case 'array':
                $this->config = $context;
                break;
            case 'string':
                $this->load($context);
                break;
            default:
                throw new InvalidContextException('Failed to initialize config');
        }
    }

    /**
     * Store a config value with a specified key
     *
     * @param  string $key   Unique configuration option key
     * @param  mixed  $value Config item value
     *
     * @return object        This Config object
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
     * Retrieve a configuration option via a provided key
     *
     * @param  string $key     Unique configuration option key
     * @param  mixed  $default Default value to return if option does not exist
     *
     * @return mixed           Stored config item or $default value
     */
    public function get($key = null, $default = null)
    {
        if (! isset($key)) return $this->config;

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
     * Check for the existance of a config item
     *
     * @param  string  $key Unique configuration option key
     *
     * @return boolean      True if item existst, otherwise false
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
     * Load configuration options from a file or directory
     *
     * @param  string $path     Path to configuration file or directory
     * @param  bool   $override Weather or not to override existing options with
     *                          values from the loaded file
     *
     * @return object           This Config object
     */
    public function load($path, $override = true)
    {
        $file = new SplFileInfo($path);

        $className = $file->isDir() ? 'Directory' : ucfirst(strtolower($file->getExtension()));
        $classPath = 'Config\\Loaders\\' . $className;

        $loader = new $classPath($path);

        if ($override) {
            $this->config = array_merge($this->config, $loader->getArray());
        } else {
            $this->config = array_merge($loader->getArray(), $this->config);
        }

        return $this;
    }

    /**
     * Merge another Config object into this one
     *
     * @param  Config $config Instance of Config
     *
     * @return object         This Config object
     */
    public function merge(Config $config)
    {
        $this->config = array_merge($this->config, $config->get());

        return $this;
    }

    /**
     * Split a sub-array of configuration options into it's own Config object
     *
     * @param  string $key   Unique configuration option key
     *
     * @return Config        A new Config object
     */
    public function split($key)
    {
        return new static($this->get($key));
    }
}
