<?php

namespace Config;

use Config\Interfaces\Loadable;
use SplFileInfo;

class Config
{
    /** @var array Array of config options */
    protected $config = [];

    /**
     * Class constructor, runs on object creation
     *
     * @param Loadable $loader Instance of Config\Interfaces\Loadable
     */
    public function __construct(Loadable $loader)
    {
        $this->config = $loader->getArray();
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
     * @param  string $path Path to configuration file or directory
     *
     * @return object       This Config\Config object
     */
    public function load($path, $override = true)
    {
        $file = new SplFileInfo($path);
        $className = $file->isDir() ? 'Directory' : ucfirst(strtolower($file->getExtension()));
        $classPath = 'Config\\Loaders\\' . $className . 'Loader';

        $loader = new $classPath($path);

        if ($override) {
            $this->config = array_merge($this->config, $loader->getArray());
        } else {
            $this->config = array_merge($loader->getArray(), $this->config);
        }

        return $this;
    }
}
