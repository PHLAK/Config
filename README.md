Config
======

[![Latest Stable Version](https://img.shields.io/packagist/v/PHLAK/Config.svg)](https://packagist.org/packages/PHLAK/Config)
[![Total Downloads](https://img.shields.io/packagist/dt/PHLAK/Config.svg)](https://packagist.org/packages/PHLAK/Config)
[![Author](https://img.shields.io/badge/author-Chris%20Kankiewicz-blue.svg)](https://www.ChrisKankiewicz.com)
[![License](https://img.shields.io/packagist/l/PHLAK/Config.svg)](https://packagist.org/packages/PHLAK/Config)
[![Build Status](https://img.shields.io/travis/PHLAK/Config.svg)](https://travis-ci.org/PHLAK/Config)

PHP library for simple configuration management -- by, [Chris Kankiewicz](https://www.ChrisKankiewicz.com) ([@PHLAK](https://twitter.com/PHLAK))

Introduction
------------

Config is a simple PHP configuration management library supporting multiple
configuration file formats and an expressive API.

Supported file formats:

  - PHP
  - INI
  - JSON
  - YAML
  - XML

Like this project? Keep me caffeinated by [making a donation](https://paypal.me/ChrisKankiewicz).

Requirements
------------

  - [PHP](https://php.net) >= 7.0

Install with Composer
---------------------

```bash
composer require phlak/config
```

Initializing the Client
-----------------------

First, import Config:

```php
use PHLAK\Config\Config;
```

Then instantiate the class:

```php
$config = new Config($context, $prefix = null);
```

Where `$context` is one of the following:

  - A path to a supported file type
  - A directory path containing one or more supported file types
  - An array of configuration options

And `$prefix` is a string to be used as a key prefix for options of this Config object.

Configuration File Formats
--------------------------

#### PHP

A PHP configuration file must have the `.php` file extension, be a valid PHP
file and and return a valid PHP array.

```php
<?php

return [
    'driver' => 'mysql',
    'drivers' => [
        'sqlite' => [
            'database' => 'database.sqlite',
            'prefix' => ''
        ],
        'mysql' => [
            'host' => 'localhost',
            'database' => 'blog',
            'username' => 'blogger',
            'password' => 'hunter2',
            'charset' => 'utf8',
            'prefix' => ''
        ]
    ]
];

```

#### INI

An INI configuration file must have the `.ini` file extension and be a valid INI
file.

```ini
driver = mysql

[drivers]

sqlite[database] =  database.sqlite
sqlite[prefix] =

mysql[host] = localhost
mysql[database] = blog
mysql[username] = blogger
mysql[password] = hunter2
mysql[charset] = utf8
mysql[prefix] =
```

#### JSON

A JSON configuration file must have the `.json` file extension and contain a
valid JSON object.

```json
{
    "driver": "mysql",
    "drivers": {
        "sqlite": {
            "database": "database.sqlite",
            "prefix": ""
        },
        "mysql": {
            "host": "localhost",
            "database": "blog",
            "username": "blogger",
            "password": "hunter2",
            "charset": "utf8",
            "prefix": ""
        }
    }
}

```

#### YAML

A YAML configuration file must have the `.yaml` file extension, be a valid YAML
file.

```yaml
driver: mysql

drivers:

  sqlite:
    database: database.sqlite
    prefix:

  mysql:
    host: localhost
    database: blog
    username: blogger
    password: hunter2
    charset: utf8
    prefix:
```

#### XML

A XML configuration file must have the `.xml` file extension and contain valid
XML.

```xml
<?xml version='1.0'?>

<database>
    <driver>mysql</driver>
    <drivers>
        <sqlite>
            <database>database.sqlite</database>
            <prefix></prefix>
        </sqlite>
        <mysql>
            <host>localhost</host>
            <database>blog</database>
            <username>blogger</username>
            <password>hunter2</password>
            <charset>utf8</charset>
            <prefix></prefix>
        </mysql>
    </drivers>
</database>
```

Usage
-----

### `Config::__construct( mixed $context [, string $prefix = null ] )`

Create a new Config object.

##### Example

```php
// Create a new Config object from a YAML file
$config = new Config('path/to/conifg.yaml');

// Create a new Config object from an array
$config = new Config([
    'hostname' => 'localhost',
    'port' => 12345
]);
```

---

### `Config::set( string $key, mixed $value ) : bool`

Set a configuration option.

##### Examples

```php
$config->set('hostname', 'localhost');
$config->set('port', 12345);
```

---

### `Config::get( string $key [, mixed $default = null ] ) : mixed`

Retrieve a configuration option.

##### Examples

```php
// Returns null if 'hostname' options is not set
$config->get('hostname');

// Returns 'localhost' if 'hostname' option is not set
$config->get('hostname', 'localhost');
```

---

### `Config::has( string $key ) : bool`

Check if a configuration option exists.

##### Example

```php
$config->has('hostname');
```

---

### `Config::load( string $path [, string $prefix = null [, bool $override = true ]] ) : self`

Load an additional configuration file:

##### Examples

```php
// Load a single additional file
$conifg->load('path/to/config.php');

// Load an additional file with a prefix
$config->load('databaes.php', 'database');

// Load an additional file without overriding exising values
$config->load('additional-options.php', null, false);
```

---

### `Config::merge( Config $config [, bool $override = true ] ) : self`

Merge two Config objects into one.

##### Examples

```php
$anotherConfig = new Config('some/config.php');

// Merge $anotherConfig into $config and override values
// in $config with values from $anotherConfig.
$config->merge($anotherConfig);

// Merge $anotherConfig into $config without overriding any
// values. Duplicate values in $anotherConfig will be lost.
$config->merge($anotherConfig, false);
```

---

### `Config::split( string $key ) : Config`

Split a sub-array of options into it's own Config object.

##### Example

```php
$config = new Config([
    'foo' => 'foo',
    'bar' => [
        'baz' => 'barbaz'
    ],
]);

$config->get('bar');     // Returns ['baz' => 'barbaz']
$config->get('bar.baz'); // Returns 'barbaz'

$barConfig = $config->split('bar');

$barConfig->get('baz');  // Returns 'barbaz'
```

---

### `Config::toArray() : array`

Return the entire configuration as an array.

##### Example

```php
$config->toArray();
```

Troubleshooting
---------------

Please report bugs to the [GitHub Issue Tracker](https://github.com/PHLAK/Config/issues).

Copyright
---------

This project is liscensed under the [MIT License](https://github.com/PHLAK/Config/blob/master/LICENSE).
