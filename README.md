Config
======

[![Latest Stable Version](https://img.shields.io/packagist/v/PHLAK/Config.svg)](https://packagist.org/packages/PHLAK/Config)
[![Total Downloads](https://img.shields.io/packagist/dt/PHLAK/Config.svg)](https://packagist.org/packages/PHLAK/Config)
[![Author](https://img.shields.io/badge/author-Chris%20Kankiewicz-blue.svg)](https://www.ChrisKankiewicz.com)
[![License](https://img.shields.io/packagist/l/PHLAK/Config.svg)](https://packagist.org/packages/PHLAK/Config)
[![Build Status](https://img.shields.io/travis/PHLAK/Config.svg)](https://travis-ci.org/PHLAK/Config)

PHP library for simple configuration management -- by, [Chris Kankiewicz](https://www.ChrisKankiewicz.com)

Introduction
------------

Config is a simple PHP configuration management library supporting multiple,
configuration file formats and an expressive API.

Supported file formats:

  - PHP
  - INI
  - JSON

Like this project? Keep me caffeinated by [making a donation](https://paypal.me/ChrisKankiewicz).

Requirements
------------

  - [PHP](https://php.net) >= 5.4

Install with Composer
---------------------

```bash
composer require phlak/config
```

Initializing the Client
-----------------------

First, import Config:

```php
use Config;
```

Then instantiate the class:

```php
$config = Config\Factory::init($pathToConfig);
```

Where `$pathToConfig` is a path to a supported file type to a directory
containing one or more supported file types.

Configuration File Formats
--------------------------

#### PHP

A PHP configuration file must have the `.php` file extension, be a valid PHP
file and and return a valid PHP array.

```php
<?php

return [
    'driver'   => 'mysql',
    'host'     => 'localhost',
    'database' => 'blog',
    'username' => 'blogger',
    'password' => 'hunter2',
    'charset'  => 'utf8',
    'prefix'   => ''
];
```

#### INI

An INI configuration file must have the `.ini` file extension and be a valid INI
file.

```ini
id            = 1234567890
name[first]   = Dade
name[last]    = Murphy
alias         = Zero Cool
date_of_birth = 1977-07-06 01:23:45
```

#### JSON

A JSON configuration file must have the `.json` file extension and contain a
valid JSON object.

```json
{
    "driver": "memcached",
    "duration": 42,
    "config": {
        "servers": [
            {"host": "server1", "port": 11211},
            {"host": "server2", "port": 11211}
        ]
    }
}
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
$conifg->load($pathToConfig);
```

Merge two Config objects into one:

```php
$config->merge($config2);
```

Troubleshooting
---------------

Please report bugs to the [GitHub Issue Tracker](https://github.com/PHLAK/Config/issues).

-----

This project is liscensed under the MIT License.

**Copyright (c) 2016 Chris Kankiewicz <Chris@ChrisKankiewicz.com>**

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.