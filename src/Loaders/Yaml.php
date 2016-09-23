<?php

namespace Config\Loaders;

class Yaml extends Loader
{
    /**
     * Retrieve the contents of a .yaml file and convert it to an array of
     * configuration options
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        $contents = file_get_contents($this->context);

        return \Symfony\Component\Yaml\Yaml::parse($contents);
    }
}
