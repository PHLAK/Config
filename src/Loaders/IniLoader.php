<?php

namespace Config\Loaders;

class IniLoader extends Loader
{
    /**
     * Retrieve the contents of a .ini file and convert it to an array of
     * configuration options
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        return parse_ini_file($this->context);
    }
}
