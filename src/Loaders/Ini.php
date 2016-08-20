<?php

namespace Config\Loaders;

use Config\Interfaces\Loadable;

class Ini extends Loader
{
    /**
     * Retrieve the contents of a .ini file and convert it to an array of
     * configuration options
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        return parse_ini_file($this->path);
    }
}
