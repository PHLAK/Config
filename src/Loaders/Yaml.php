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
        $contents = file_get_contents($this->context);

        if ($contents === false) {
            throw new InvalidFileException(sprintf('Unable to parse file [%s]', $this->context));
        }

        try {
            $parsed = YamlParser::parse($contents);
        } catch (ParseException $exception) {
            throw new InvalidFileException($exception->getMessage());
        }

        if (! is_array($parsed)) {
            throw new InvalidFileException('Unable to parse invalid YAML file at ' . $this->context);
        }

        return $parsed;
    }
}
