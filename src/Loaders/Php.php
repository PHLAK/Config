<?php

namespace Config\Loaders;

use Config\Interfaces\Loadable;
use Exception;

class Php extends Loader
{
    /**
     * Retrieve the contents of a .php configuration file and convert it to an
     * array of configuration options
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        $contents = include($this->path);

        if (gettype($contents) != 'array') {
            throw new Exception('File ' . $this->path . ' does not contain a valid array');
        }

        return $contents;
    }
}
