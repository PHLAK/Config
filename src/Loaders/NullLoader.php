<?php

namespace Config\Loaders;

class NullLoader extends Loader
{
    /**
     * Return an empty array when no context is provided
     *
     * @return array An empty array
     */
    public function getArray()
    {
        return [];
    }
}
