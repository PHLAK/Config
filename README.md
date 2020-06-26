<p align="center">
    <img src="config.png" alt="Config" width="500">
</p>

<p align="center">
    <a href="https://spectrum.chat/phlaknet"><img src="https://img.shields.io/badge/Join_the-Community-7b16ff.svg?style=for-the-badge" alt="Join our Community"></a>
    <a href="https://github.com/users/PHLAK/sponsorship"><img src="https://img.shields.io/badge/Become_a-Sponsor-cc4195.svg?style=for-the-badge" alt="Become a Sponsor"></a>
    <a href="https://paypal.me/ChrisKankiewicz"><img src="https://img.shields.io/badge/Make_a-Donation-006bb6.svg?style=for-the-badge" alt="One-time Donation"></a>
    <br>
    <a href="https://packagist.org/packages/PHLAK/Config"><img src="https://img.shields.io/packagist/v/PHLAK/Config.svg?style=flat-square" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/PHLAK/Config"><img src="https://img.shields.io/packagist/dt/PHLAK/Config.svg?style=flat-square" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/PHLAK/Config"><img src="https://img.shields.io/packagist/l/PHLAK/Config.svg?style=flat-square" alt="License"></a>
    <a href="https://travis-ci.org/PHLAK/Config"><img src="https://img.shields.io/travis/PHLAK/Config.svg?style=flat-square" alt="Build Status"></a>
    <a href="https://github.styleci.io/repos/66168184"><img src="https://github.styleci.io/repos/66168184/shield?branch=master" alt="StyleCI"></a>
</p>

<p align="center">
    PHP library for simple configuration management
    -- Created by <a href="https://www.ChrisKankiewicz.com">Chris Kankiewicz</a>
    (<a href="https://twitter.com/PHLAK">@PHLAK</a>)
</p>

---

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

<details>
  <summary>Example PHP file</summary>

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
</details>

### INI

An INI configuration file must have the `.ini` file extension and be a valid INI
file.

<details>
  <summary>Example INI file</summary>

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
</details>

### JSON

A JSON configuration file must have the `.json` file extension and contain a
valid JSON object.

<details>
  <summary>Example JSON file</summary>

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
</details>

### TOML

A TOML configuration file must have the `.toml` file extension and be a valid
TOML file.

<details>
  <summary>Example TOML file</summary>

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
</details>

### YAML

A YAML configuration file must have the `.yaml` file extension, be a valid YAML
file.

<details>
  <summary>Example YAML file</summary>

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
</details>

### XML

A XML configuration file must have the `.xml` file extension and contain valid
XML.

<details>
  <summary>Example XML file</summary>

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
</details>

Usage
-----

### __construct
> Create a new Config object.

```php
Config::__construct( mixed $context [, string $prefix = null ] ) : Config
```

<dl>
  <dt><code>$context</code></dt>
  <dd>Raw array of configuration options or path to a configuration file or directory containing one or more configuration files</dd>  
  
  <dt><code>$prefix</code></dt>
  <dd>A key under which the loaded config will be nested</dd>
</dl>

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

<dl>
  <dt><code>$key</code></dt>
  <dd>Unique configuration option key</dd>
  
  <dt><code>$value</code></dt>
  <dd>Config item value</dd>
</dl>

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

<dl>
  <dt><code>$key</code></dt>
  <dd>Unique configuration option key</dd>
  
  <dt><code>$value</code></dt>
  <dd>Config item value</dd>
</dl>

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

<dl>
  <dt><code>$key</code></dt>
  <dd>Unique configuration option key</dd>
</dl>

#### Example

```php
$config = new Config([
    'hostname' => 'localhost'
]);

$config->has('hostname'); // Returns true
$config->has('port');     // Returns false
```

---

### append
> Append a value onto an existing array configuration option.

```php
Config::append( string $key, mixed $value ) : bool
```

<dl>
  <dt><code>$key</code></dt>
  <dd>Unique configuration option key</dd>
  
  <dt><code>$value</code></dt>
  <dd>Config item value</dd>
</dl>

#### Example

Append `baz` to the `tags` config item array.

```php
$config->set('tags', ['foo', 'bar'])
$config->append('tags', 'baz'); // ['foo', 'bar', 'baz']
```

---

### prepend
> Prepend a value onto an existing array configuration option.

```php
Config::append( string $key, mixed $value ) : bool
```

<dl>
  <dt><code>$key</code></dt>
  <dd>Unique configuration option key</dd>
  
  <dt><code>$value</code></dt>
  <dd>Config item value</dd>
</dl>

#### Example

Prepend `baz` to the `tags` config item array.

```php
$config->set('tags', ['foo', 'bar'])
$config->append('tags', 'baz'); // ['baz', 'foo', 'bar']
```

---

### unset
> Unset a configuration option via a provided key.

```php
Config::unset( string $key ) : bool
```

<dl>
  <dt><code>$key</code></dt>
  <dd>Unique configuration option key</dd>
</dl>

#### Example

```php
$config->unset('hostname');
```

---

### load
> Load configuration options from a file or directory.

```php
Config::load( string $path [, string $prefix = null [, bool $override = true ]] ) : self
```

<dl>
  <dt><code>$path</code></dt>
  <dd>Path to configuration file or directory</dd>
  
  <dt><code>$prefix</code></dt>
  <dd>A key under which the loaded config will be nested</dd>
  
  <dt><code>$override</code></dt>
  <dd>Whether or not to override existing options with values from the loaded file</dd>
</dl>

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

<dl>
  <dt><code>$config</code></dt>
  <dd>Instance of Config</dd>
  
  <dt><code>$override</code></dt>
  <dd>Whether or not to override existing options with values from the merged config object</dd>
</dl>

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

<dl>
  <dt><code>$key</code></dt>
  <dd>Unique configuration option key</dd>
</dl>

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

For general help and support join our [Spectrum Community](https://spectrum.chat/phlaknet) or reach out on [Twitter](https://twitter.com/PHLAK).

Please report bugs to the [GitHub Issue Tracker](https://github.com/PHLAK/Config/issues).

Copyright
---------

This project is liscensed under the [MIT License](https://github.com/PHLAK/Config/blob/master/LICENSE).
