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

Config is a simple PHP configuration management library supporting multiple,
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

  - [PHP](https://php.net) >= 5.6

Install with Composer
---------------------

```bash
composer require phlak/config
```

Initializing the Client
-----------------------

First, import Config:

```php
use PHLAK\Config;
```

Then instantiate the class:

```php
$config = new Config\Config($context, $prefix = null);
```

Where `$context` is a path to a supported file type, a directory containing one
or more supported file types or an array of configuration options.

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

Set a configuration option:

```php
$config->set($key, $value);
```

Retrieve a configuration option:

```php
$config->get($key, $default = null);
```

Check if a configuration option exists:

```php
$config->has($key, $override = false);
```

Load an additional configuration file:

```php
$conifg->load($pathToConfig, $prefix = null, $override = true);
```

Merge two Config objects into one:

```php
$config = new Config\Config(['foo' => 'foo', 'baz' => 'baz']);
$gifnoc = new Config\Config(['bar' => 'rab', 'baz' =>'zab']);

$config->merge($gifnoc);

$config->get('foo'); // Returns 'foo'
$config->get('bar'); // Returns 'rab'
$config->get('baz'); // Returns 'zab'
```

Split a sub-array of options into it's own object:

```php
$config = new Config\Config([
    'foo' => 'foo',
    'bar' => [
        'baz' => 'barbaz'
    ]
]);

$bar = $config->split('bar');

$bar->get('baz'); // Returns 'barbaz'
```

Troubleshooting
---------------

Please report bugs to the [GitHub Issue Tracker](https://github.com/PHLAK/Config/issues).

Copyright
---------

This project is liscensed under the [MIT License](https://github.com/PHLAK/Config/blob/master/LICENSE).
