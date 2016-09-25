<?php

namespace Config\Loaders;

use Config\Exceptions\InvalidFileException;

class Json extends Loader
{
    /**
     * Retrieve the contents of a .json file and convert it to an array of
     * configuration options
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        $contents = file_get_contents($this->context);

        $parsed = json_decode($contents, true);

        if (is_null($parsed)) {
            throw new InvalidFileException;
        }

        return $parsed;
    }
}
