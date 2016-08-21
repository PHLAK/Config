<?php

namespace Config\Loaders;

class ArrayLoader extends Loader
{
    /**
     * Retrieve the contents of a .json file and convert it to an array of
     * configuration options
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        return $this->context;
    }
}
