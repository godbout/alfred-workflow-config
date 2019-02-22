<h1 align="center">Alfred Workflow Config</h1>

<p align="center">
    <a href="https://packagist.org/packages/godbout/alfred-workflow-config"><img src="https://img.shields.io/packagist/v/godbout/alfred-workflow-config.svg?style=flat-square" alt="Latest Version on Packagist"></a>
    <a href="https://travis-ci.org/godbout/alfred-workflow-config"><img src="https://img.shields.io/travis/godbout/alfred-workflow-config/master.svg?style=flat-square" alt="Build Status"></a>
    <a href="https://scrutinizer-ci.com/g/godbout/alfred-workflow-config"><img src="https://img.shields.io/scrutinizer/g/godbout/alfred-workflow-config.svg?style=flat-square" alt="Quality Score"></a>
    <a href="https://packagist.org/packages/godbout/alfred-workflow-config"><img src="https://img.shields.io/packagist/dt/godbout/alfred-workflow-config.svg?style=flat-square" alt="Total Downloads"></a>
</p>

<p align="center">
    Easily read and write config settings for your Alfred 3 Workflow. We took care of the <a href="#behind-the-scenes">boring stuff</a> for you.
</p>

___


## Installation

```bash
composer require godbout/alfred-workflow-config
```

## Usage

Import the class:

```php
require 'vendor/autoload.php';

use Godbout\Alfred\Workflow\Config;
```

Then you can start save settings. Use [dot notation](https://github.com/adbario/php-dot-notation) for nested settings:

```php
Config::write('language', 'english');

Config::write('workflow.user.name', 'Guill');
```

Read settings:

```php
$language = Config::read('language');

$userName = Config::read('workflow.user.name');
```

You can provide a default config for your workflow. It will only be saved if no config is found:
```php
Config::ifEmptyStartWith(['version' => 1.0, 'enabled' => true]);
```

## ArrayAccess

There is none. We don't keep an array of settings internally, so there's no way to implement completely ArrayAccess. You could read settings through an array notation but not add a new setting, so the whole ArrayAccess implementation has been put to sleep.

## Behind the scenes

1. We create the [Alfred Workflow Data](https://www.alfredapp.com/help/workflows/script-environment-variables/) folder if it doesn't exist. 
2. We create a `config.json` file and store the settings, well, in pretty json.
3. We directly read and write to the config file, so even if your workflow crashes after, your settings will be saved as soon as you call the method.
