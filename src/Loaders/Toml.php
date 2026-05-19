<?php

declare(strict_types=1);

namespace PHLAK\Config\Loaders;

use Internal\Toml\Exception\SyntaxException;
use Internal\Toml\Toml as TomlParser;
use PHLAK\Config\Exceptions\InvalidFileException;

class Toml extends Loader
{
    /**
     * Retrieve the contents of a .toml file and convert it to an array of
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
            throw new InvalidFileException('Unable to read TOML file at ' . $this->context);
        }

        try {
            /** @throws SyntaxException */
            $parsed = TomlParser::parseToArray($contents);
        } catch (SyntaxException $exception) {
            throw new InvalidFileException($exception->getMessage());
        }

        return $parsed;
    }
}
