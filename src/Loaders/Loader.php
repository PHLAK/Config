<?php

namespace Config\Loaders;

use Config\Interfaces\Loadable;

abstract class Loader implements Loadable
{
    /** @var string Path to configuration file or directory */
    protected $path;

    /**
     * Class constructor, loads on object creation
     *
     * @param string $path Path to configuration file or directory
     */
    public function __construct($path)
    {
        $this->path = $path;
    }
}