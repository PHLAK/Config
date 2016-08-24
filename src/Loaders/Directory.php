<?php

namespace Config\Loaders;

use DirectoryIterator;

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

        foreach (new DirectoryIterator($this->context) as $file) {
            // TODO: Load files from directories recursively
            if ($file->isDot() || $file->isDir()) continue;

            $className = ucfirst(strtolower($file->getExtension()));
            $classPath = 'Config\\Loaders\\' . $className;

            $loader = new $classPath($file->getPathname());

            $contents = array_merge($contents, $loader->getArray());
        }

        return $contents;
    }
}
