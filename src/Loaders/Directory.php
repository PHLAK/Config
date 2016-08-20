<?php

namespace Config\Loaders;

use Config\Interfaces\Loadable;
use DirectoryIterator;
use SplFileInfo;

class Directory extends Loader
{
    /**
     * Retrieve the contents of one or more configuration files in a directory
     * and convert them to an array of configuration options
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        $contents = [];

        foreach (new DirectoryIterator($this->path) as $file) {
            // TODO: Load files from directories recursively
            if ($file->isDot() || $file->isDir()) continue;

            $className = ucfirst(strtolower($file->getExtension()));
            $classPath = 'Config\\Loaders\\' . $className;

            $loader = new $classPath($file->getPathname());

            $contents[strtolower($file->getBasename('.' . $file->getExtension()))] = $loader->getArray();
        }

        return $contents;
    }
}
