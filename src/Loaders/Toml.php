<?php

namespace PHLAK\Config\Loaders;

use PHLAK\Config\Exceptions\InvalidFileException;
use Yosymfony\Toml\Exception\ParseException;
use Yosymfony\Toml\Toml as TomlParser;

class Toml extends Loader
{
    /**
     * Retrieve the contents of a .toml file and convert it to an array of
     * configuration options.
     *
     * @return array Array of configuration options
     */
    public function getArray()
    {
        try {
            $parsed = TomlParser::ParseFile($this->context);
        } catch (ParseException $e) {
            throw new InvalidFileException($e->getMessage());
        }

        // if (! is_array($parsed)) {
        //     throw new InvalidFileException('Unable to parse invalid TOML file at ' . $this->context);
        // }

        return $parsed;
    }
}
