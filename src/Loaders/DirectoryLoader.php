<?php

namespace Config\Loaders;

use DirectoryIterator;

class DirectoryLoader extends Loader
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
            $classPath = 'Config\\Loaders\\' . $className . 'Loader';

            $loader = new $classPath($file->getPathname());

            $contents[$this->key($file->getBasename())] = $loader->getArray();
        }

        return $contents;
    }

    protected function key($fileName)
    {
        $baseName = strtolower(pathinfo($fileName, PATHINFO_FILENAME));
        return implode('_', explode(' ', str_replace('  ', ' ', $baseName)));
    }
}
