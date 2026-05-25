<?php

declare(strict_types=1);

namespace PHLAK\Config\Loaders;

use DirectoryIterator;
use PHLAK\Config\Exceptions\InvalidFileException;
use PHLAK\Config\Loaders;
use RuntimeException;

class Directory extends Loader
{
    /**
     * Retrieve the contents of one or more configuration files in a directory
     * and convert them to an array of configuration options. Any invalid files
     * will be silently ignored.
     *
     * @return array Array of configuration options
     */
    public function getArray(): array
    {
        $contents = [];

        foreach (new DirectoryIterator($this->context) as $file) {
            if ($file->isDot()) {
                continue;
            }

            $extension = $file->getExtension();

            /** @var class-string<Loader> $loaderClass */
            $loaderClass = $file->isDir() ? Loaders\Directory::class : match (strtolower($extension)) {
                'ini' => Loaders\Ini::class,
                'json' => Loaders\Json::class,
                'php' => Loaders\Php::class,
                'toml' => Loaders\Toml::class,
                'xml' => Loaders\Xml::class,
                'yaml', 'yml' => Loaders\Yaml::class,
                default => throw new RuntimeException(sprintf('No loader for extension [%s]', $extension)),
            };

            if (!class_exists($classPath)) {
                continue;
            }

            /** @var Loader $loader */
            $loader = new $loaderClass($file->getPathname());

            try {
                $contents = array_merge($contents, $loader->getArray());
            } catch (InvalidFileException) {
                continue;
            }
        }

        return $contents;
    }
}
