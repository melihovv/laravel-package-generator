Laravel package generator
=========================

[![Build Status](https://travis-ci.org/melihovv/laravel-package-generator.svg?branch=master)](https://travis-ci.org/melihovv/laravel-package-generator)
[![styleci](https://styleci.io/repos/96041272/shield)](https://styleci.io/repos/96041272)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/91239e6a-d51b-495c-9dc7-90d2ac8805f3/mini.png)](https://insight.sensiolabs.com/projects/91239e6a-d51b-495c-9dc7-90d2ac8805f3)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/melihovv/laravel-package-generator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/melihovv/laravel-package-generator/?branch=master)

[![Packagist](https://img.shields.io/packagist/v/melihovv/laravel-package-generator.svg)](https://packagist.org/packages/melihovv/laravel-package-generator)
[![Packagist](https://poser.pugx.org/melihovv/laravel-package-generator/d/total.svg)](https://packagist.org/packages/melihovv/laravel-package-generator)
[![Packagist](https://img.shields.io/packagist/l/melihovv/laravel-package-generator.svg)](https://packagist.org/packages/melihovv/laravel-package-generator)

Simple package to quickly generate basic structure for other laravel packages.

## Install

Install via composer
```
composer require --dev melihovv/laravel-package-generator
```

Add service provider to `config/app.php` in `providers` section (it is optional
step if you use laravel>=5.5 with package auto discovery feature)

```php
Melihovv\LaravelPackageGenerator\ServiceProvider::class,
```

Publish package config if you want customize default values
```
php artisan vendor:publish --provider="Melihovv\LaravelPackageGenerator\ServiceProvider" --tag="config"
```

## Available commands

### php artisan package:new vendor package

Create new package.

Example: `php artisan package:new Melihovv SomeAwesomePackage`

This command will:

* Create `packages/melihovv/some-awesome-package` folder
* Register package in app composer.json
* Copy package skeleton from skeleton folder to created folder (you can provide
your custom skeleton path in config)
* Run `composer dump-autoload`

I recommend to run this command with interactive `-i` flag:
```
php artisan package:new Melihovv SomeAwesomePackage -i
```

This way you will be prompted for every needed value.

### php artisan package:remove

Remove the existing package.

Example: `php artisan package:remove Melihovv SomeAwesomePackage`

This command will:

* Remove `packages/melihovv/some-awesome-package` folder
* Unregister package in app composer.json
* Run `composer dump-autoload`

Interactive mode also possible.

### php artisan package:clone

Clone the existing package.

Example: `php artisan package:clone https://github.com/melihovv/laravel-env-validator Melihovv LaravelEnvValidator --src=src/LaravelEnvValidator`

This command will:

* Clone specified repo in `packages/melihovv/laravel-env-validator` folder
* Register package auto loading in app composer.json with this path
`packages/melihovv/laravel-env-validator/src/LaravelEnvValidator`
* Run `composer dump-autoload`

Interactive mode also possible. If you need you can specify which branch to
clone with `-b` flag.

## Custom skeleton

This package will copy all folders and files from specified skeleton path to
package folder. You can use templates in your skeleton. All files with `tpl`
extension will be provided with some variables available to use in them. `tpl`
extension will be stripped.

Available variables to use in templates:

* vendor (e.g. Melihovv)
* package (e.g. SomeAwesomePackage)
* vendorFolderName (e.g. melihovv)
* packageFolderName (e.g. some-awesome-package)
* packageHumanName (e.g. Some awesome package)
* composerName (e.g. melihovv/some-awesome-package)
* composerDesc (e.g. A some awesome package)
* composerKeywords (e.g. some,awesome,package)
* licence (e.g. MIT)
* phpVersion (e.g. >=7.0)
* aliasName (e.g. some-awesome-package)
* configFileName (e.g. some-awesome-package)
* year (e.g. 2017)
* name (e.g. Alexander Melihov)
* email (e.g. amelihovv@ya.ru)
* githubPackageUrl (e.g. https://github.com/melihov/some-awesome-package)

## Things you need to to manually:

* Service provider and alias registration (if you use laravel <5.5)
* In README.md:
  * StyleCI repository identifier
  * Sensio Insight repository identifier
  * Package description
  * Usage section

## Security

If you discover any security related issues, please email amelihovv@ya.ru instead of using the issue tracker.

## Credits

- [Alexander Melihov](https://github.com/melihovv)
- [All contributors](https://github.com/melihovv/laravel-package-generator/graphs/contributors)
