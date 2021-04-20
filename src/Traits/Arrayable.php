<?php

namespace PHLAK\Config\Traits;

use ArrayIterator;
use Traversable;

trait Arrayable
{
    /**
     * Retrieve an the config array as an iterator.
     *
     * @return Traversable The conifg as a traversable iterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->config);
    }

    /**
     * Determine whether an item exists at a specific offset.
     *
     * @param int $offset Offset to check for existence
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->config[$offset]);
    }

    /**
     * Retrieve an item at a specific offset.
     *
     * @param int $offset Position of character to get
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->config[$offset];
    }

    /**
     * Assign a value to the specified item at a specific offset.
     *
     * @param mixed $offset The offset to assign the value to
     * @param mixed $value The value to set
     */
    public function offsetSet($offset, $value)
    {
        $this->config[$offset] = $value;
    }

    /**
     * Unset an item at a specific offset.
     *
     * @param $offset The offset to unset
     */
    public function offsetUnset($offset)
    {
        unset($this->config[$offset]);
    }
}
