<?php

namespace PHLAK\Config\Loaders;

use PHLAK\Config\Exceptions\InvalidFileException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml as YamlParser;

class Yaml extends Loader
{
    /**
     * Retrieve the contents of a .yaml file and convert it to an array of
     * configuration options.
     *
     * @throws \PHLAK\Config\Exceptions\InvalidFileException
     *
     * @return array Array of configuration options
     */
    public function getArray(): array
    {
        try {
            $parsed = YamlParser::parse(file_get_contents($this->context));
        } catch (ParseException $e) {
            throw new InvalidFileException($e->getMessage());
        }

        if (! is_array($parsed)) {
            throw new InvalidFileException('Unable to parse invalid YAML file at ' . $this->context);
        }

        return $parsed;
    }
}
