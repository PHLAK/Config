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
  - [TOML](https://github.com/toml-lang/toml)
  - YAML
  - XML

#### Like this project?

[![Join the community on Spectrum](https://img.shields.io/badge/Join_the_community-PHLAKNET-7a15fe.svg)](https://spectrum.chat/phlaknet)
[![Become a Patron](https://img.shields.io/badge/Become_a-Patron-f96854.svg)](https://patreon.com/PHLAK)
[![One-time Donation](https://img.shields.io/badge/Make_a-Donation-006bb6.svg)](https://paypal.me/ChrisKankiewicz)

Requirements
------------

  - [PHP](https://php.net) >= 7.1

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

### PHP

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

### INI

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

### JSON

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

### TOML

A TOML configuration file must have the `.toml` file extension and be a valid
TOML file.

```toml
driver = 'mysql'

[drivers.sqlite]
database = 'database.sqlite'
prefix = ''

[drivers.mysql]
host = 'localhost'
database = 'blog'
username = 'blogger'
password = 'hunter2'
charset = 'utf8'
prefix = ''
```

### YAML

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

### XML

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

### __construct
> Create a new Config object.

```php
Config::__construct( mixed $context [, string $prefix = null ] ) : Config
```

| Parameter  | Description                                                                                                                 |
| ---------- | --------------------------------------------------------------------------------------------------------------------------- |
| `$context` | Raw array of configuration options or path to a configuration file or directory containing one or more configuration files  |
| `$prefix`  | A key under which the loaded config will be nested                                                                          |

#### Examples

Create a new Config object from a YAML file.

```php
$config = new Config('path/to/conifg.yaml');
```

Create a new Config object from a directory of config files.

```php
$config = new Config('path/to/conifgs/');
```

Create a new Config object from an array.

```php
$config = new Config([
    'hostname' => 'localhost',
    'port' => 12345
]);
```

---

### set
> Store a config value with a specified key.

```php
Config::set( string $key, mixed $value ) : bool
```

| Parameter | Description                      |
| --------- | -------------------------------- |
| `$key`    | Unique configuration option key  |
| `$value`  | Config item value                |

#### Example

```php
$config->set('hostname', 'localhost');
$config->set('port', 12345);
```

---

### get
> Retrieve a configuration option via a provided key.

```php
Config::get( string $key [, mixed $default = null ] ) : mixed
```

| Parameter | Description                                      |
| --------- | ------------------------------------------------ |
| `$key`    | Unique configuration option key                  |
| `$value`  | Default value to return if option does not exist |

#### Examples

```php
// Return the hostname option value or null if not found.
$config->get('hostname');
```

Define a default value to return if the option is not set.

```php
// Returns 'localhost' if hostname option is not set
$config->get('hostname', 'localhost');
```

---

### has
> Check for the existence of a configuration item.

```php
Config::has( string $key ) : bool
```

| Parameter | Description                     |
| --------- | ------------------------------- |
| `$key`    | Unique configuration option key |

#### Example

```php
$config = new Config([
    'hostname' => 'localhost'
]);

$config->has('hostname'); // Returns true
$config->has('port');     // Returns false
```

---

### load
> Load configuration options from a file or directory.

```php
Config::load( string $path [, string $prefix = null [, bool $override = true ]] ) : self
```

| Parameter   | Description                                                                  |
| ----------- | ---------------------------------------------------------------------------- |
| `$path`     | Path to configuration file or directory                                      |
| `$prefix`   | A key under which the loaded config will be nested                           |
| `$override` | Whether or not to override existing options with values from the loaded file |


#### Examples

Load a single additional file.

```php
$conifg->load('path/to/config.php');
```

Load an additional file with a prefix.

```php
$config->load('databaes.php', 'database');
```

Load an additional file without overriding existing values.

```php
$config->load('additional-options.php', null, false);
```

---

### merge
> Merge another Config object into this one.

```php
Config::merge( Config $config [, bool $override = true ] ) : self
```

| Parameter   | Description                                                                           |
| ----------- | ------------------------------------------------------------------------------------- |
| `$config`   | Instance of Config                                                                    |
| `$override` | Whether or not to override existing options with values from the merged config object |

#### Examples


Merge $anotherConfig into $config and override values in `$config` with values
from `$anotherConfig`.

```php
$anotherConfig = new Config('some/config.php');

$config->merge($anotherConfig);
```

Merge `$anotherConfig` into `$config` without overriding any values. Duplicate
values in `$anotherConfig` will be lost.

```php
$anotherConfig = new Config('some/config.php');

$config->merge($anotherConfig, false);
```

---

### split
> Split a sub-array of configuration options into it's own Config object.

```php
Config::split( string $key ) : Config
```

| Parameter | Description                     |
| --------- | ------------------------------- |
| `$key`    | Unique configuration option key |

#### Example

```php
$config = new Config([
    'foo' => 'foo',
    'bar' => [
        'baz' => 'barbaz'
    ],
]);

$barConfig = $config->split('bar');

$barConfig->get('baz');  // Returns 'barbaz'
```

---

### toArray
> Return the entire configuration as an array.

```php
Config::toArray( void ) : array
```

#### Example

```php
$config = new Config(['foo' => 'foo']);

$config->toArray(); // Returns ['foo' => 'foo']
```

---

Troubleshooting
---------------

For general help and support join our [Spectrum community](https://spectrum.chat/phlaknet).

Please report bugs to the [GitHub Issue Tracker](https://github.com/PHLAK/Config/issues).

Copyright
---------

This project is liscensed under the [MIT License](https://github.com/PHLAK/Config/blob/master/LICENSE).
