<?php

namespace PHLAK\Config\Interfaces;

interface ConfigInterface
{
    /**
     * Create a new instance of a ConfigInterface object.
     *
     * @param array|string $context Raw array of configuration options or path to a
     *                              configuration file or directory containing one or
     *                              more configuration files
     * @param string $prefix A key under which the loaded config will be nested
     */
    public function __construct($context = null, string $prefix = null);

    /**
     * Create a new instance of a ConfigInterface objet from a directory with
     * prefixed entries by file.
     *
     * @param string $path A path to a directory of configuration files
     */
    public static function fromDirectory(string $path): self;

    /**
     * Store a config value with a specified key.
     *
     * @param string $key Unique configuration option key
     * @param mixed $value Config item value
     *
     * @return bool True on success, otherwise false
     */
    public function set(string $key, $value): bool;

    /**
     * Retrieve a configuration option via a provided key.
     *
     * @param string $key Unique configuration option key
     * @param mixed $default Default value to return if option does not exist
     *
     * @return mixed Stored config item or $default value
     */
    public function get(string $key, $default = null);

    /**
     * Check for the existence of a configuration item.
     *
     * @param string $key Unique configuration option key
     *
     * @return bool True if item existst, otherwise false
     */
    public function has(string $key): bool;

    /**
     * Append a value onto the end of an existing array configuration option.
     *
     * @param string $key Unique configuration option key
     * @param mixed $value Config item value
     *
     * @throws \RuntimeException
     *
     * @return true
     */
    public function append(string $key, $value): bool;

    /**
     * Prepend a value onto the beginning of an existing array configuration option.
     *
     * @param string $key Unique configuration option key
     * @param mixed $value Config item value
     *
     * @throws \RuntimeException
     *
     * @return true
     */
    public function prepend(string $key, $value): bool;

    /**
     * Unset a configuration option via a provided key.
     *
     * @param string $key Unique configuration option key
     *
     * @return bool True on success, otherwise false
     */
    public function unset(string $key): bool;

    /**
     * Load configuration options from a file or directory.
     *
     * @param string $path Path to configuration file or directory
     * @param string $prefix A key under which the loaded config will be nested
     * @param bool $override Whether or not to override existing options with
     *                       values from the loaded file
     */
    public function load(string $path, string $prefix = null, bool $override = true): self;

    /**
     * Merge another instance of ConfigInterface into this one.
     *
     * @param self $config Instance of ConfigInterface
     * @param bool $override Whether or not to override existing options with
     *                       values from the merged config object
     *
     * @return self This ConfigInterface object
     */
    public function merge(self $config, bool $override = true): self;

    /**
     * Split a sub-array of configuration options into it's own instance of a
     * ConfigInterface object.
     *
     * @param string $key Unique configuration option key
     */
    public function split(string $key): self;

    /**
     * Return the entire configuration as an array.
     *
     * @return array The configuration array
     */
    public function toArray(): array;
}
