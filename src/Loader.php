<?php

namespace Config;

use SplFileInfo;

class Loader
{
    /** Protected constructor to prevent newing up of the class */
    protected function __construct() {}

    /**
     * Dynamically initialize a Loadable object
     *
     * @param  string $path Path to configuration file or directory
     *
     * @return Loadable      Instance of Config\Interfaces\Loadable
     */
    public static function load($path)
    {
        $info = new SplFileInfo($path);

        $className = $info->isDir() ? 'Directory' : ucfirst(strtolower($info->getExtension()));
        $classPath = 'Config\\Loaders\\' . $className;

        return new $classPath($path);
    }
}