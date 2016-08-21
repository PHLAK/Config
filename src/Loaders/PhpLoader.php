<?php

namespace Config\Loaders;

use Exception;

class PhpLoader extends Loader
{
    /**
     * Retrieve the contents of a .php configuration file and convert it to an
     * array of configuration options
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        $contents = include($this->context);

        if (gettype($contents) != 'array') {
            throw new Exception('File ' . $this->context . ' does not contain a valid array');
        }

        return $contents;
    }
}
