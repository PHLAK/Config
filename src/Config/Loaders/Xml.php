<?php

namespace Config\Loaders;

use Config\Exceptions\InvalidFileException;

class Xml extends Loader
{
    /**
     * Retrieve the contents of a .json file and convert it to an array of
     * configuration options.
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        $parsed = @simplexml_load_file($this->context);

        if (! $parsed) {
            throw new InvalidFileException;
        }

        return json_decode(json_encode($parsed), true);
    }
}
