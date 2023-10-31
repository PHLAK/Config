<?php

namespace PHLAK\Config\Loaders;

use JsonException;
use PHLAK\Config\Exceptions\InvalidFileException;

class Xml extends Loader
{
    /**
     * Retrieve the contents of a .json file and convert it to an array of
     * configuration options.
     *
     * @throws \PHLAK\Config\Exceptions\InvalidFileException
     *
     * @return array Array of configuration options
     */
    public function getArray(): array
    {
        $parsed = @simplexml_load_file($this->context);

        if ($parsed === false) {
            throw new InvalidFileException('Unable to parse invalid XML file at ' . $this->context);
        }

        try {
            $json = json_encode($parsed, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new InvalidFileException(previous: $exception);
        }

        /** @var array $array */
        $array = json_decode($json, true);

        return $array;
    }
}
