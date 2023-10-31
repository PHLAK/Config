<?php

namespace PHLAK\Config\Traits;

use ArrayIterator;
use Traversable;

trait Arrayable
{
    /**
     * Retrieve the config array as an iterator.
     *
     * @return Traversable The config as a traversable iterator
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->config);
    }

    /**
     * Determine whether an item exists at a specific offset.
     *
     * @param mixed $offset Offset to check for existence
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->config[$offset]);
    }

    /**
     * Retrieve an item at a specific offset.
     *
     * @param mixed $offset Position of character to get
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->config[$offset];
    }

    /**
     * Assign a value to the specified item at a specific offset.
     *
     * @param mixed $offset The offset to assign the value to
     * @param mixed $value The value to set
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->config[$offset] = $value;
    }

    /**
     * Unset an item at a specific offset.
     *
     * @param mixed $offset The offset to unset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->config[$offset]);
    }
}
