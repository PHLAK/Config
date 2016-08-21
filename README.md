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

  - .php
  - .ini
  - .json

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
$config = Config\Factory::init();
```

Usage
-----

Set a configuration option:

```php
$config->set($key, $value);
```

Retrieve a configuration option:

```php
$config->get($key);
```

Troubleshooting
---------------

Please report bugs to the [GitHub Issue Tracker](https://github.com/PHLAK/Config/issues).

-----

MIT License

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