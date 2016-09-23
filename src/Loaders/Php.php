<?php

namespace Config\Loaders;

use RuntimeException;

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
        $contents = include($this->context);

        if (gettype($contents) != 'array') {
            throw new RuntimeException('File ' . $this->context . ' does not return a valid array');
        }

        return $contents;
    }
}
