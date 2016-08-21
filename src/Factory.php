<?php

namespace Config;

use Exception;
use SplFileInfo;

class Factory
{
    /** Protected constructor to prevent newing up the class */
    protected function __construct() {}

    /**
     * Initialize a concrete implementation of Config
     *
     * @param  mixed         $context Raw array of configuration options or path
     *                                to a configuration file or directory
     *
     * @return Config          Concrete instance of Config
     */
    public function init($context = null)
    {
        switch (gettype($context)) {
            case 'NULL':
                $classPath = 'Config\\Loaders\\NullLoader';
                break;
            case 'array':
                $classPath = 'Config\\Loaders\\ArrayLoader';
                break;
            case 'string':
                $file = new SplFileInfo($context);
                $className = $file->isDir() ? 'Directory' : ucfirst(strtolower($file->getExtension()));
                $classPath = 'Config\\Loaders\\' . $className . 'Loader';
                break;
            default:
                throw new Exception('Invalid context supplied, failed to initialize Config');
                break;
        }

        return new Config(new $classPath($context));
    }
}