<?php

namespace Config\Loaders;

use Config\Interfaces\Loadable;

abstract class Loader implements Loadable
{
    /** @var mixed Raw array of path to a configuration file or directory */
    protected $context;

    /**
     * Class constructor, loads on object creation.
     *
     * @param mixed $context Path to configuration file or directory
     */
    public function __construct($context)
    {
        $this->context = $context;
    }
}
