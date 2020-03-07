Laravel package generator
=========================

[![GitHub Workflow Status](https://github.com/melihovv/laravel-package-generator/workflows/Run%20tests/badge.svg)](https://github.com/melihovv/laravel-package-generator/actions)
[![styleci](https://styleci.io/repos/96041272/shield)](https://styleci.io/repos/96041272)

[![Packagist](https://img.shields.io/packagist/v/melihovv/laravel-package-generator.svg)](https://packagist.org/packages/melihovv/laravel-package-generator)
[![Packagist](https://poser.pugx.org/melihovv/laravel-package-generator/d/total.svg)](https://packagist.org/packages/melihovv/laravel-package-generator)
[![Packagist](https://img.shields.io/packagist/l/melihovv/laravel-package-generator.svg)](https://packagist.org/packages/melihovv/laravel-package-generator)

Simple package to quickly generate basic structure for other laravel packages.

## Install

Install via composer
```bash
composer require --dev melihovv/laravel-package-generator
```

Publish package config if you want customize default values
```bash
php artisan vendor:publish --provider="Melihovv\LaravelPackageGenerator\ServiceProvider" --tag="config"
```

## Available commands

### php artisan package:new -i {vendor} {package}

Create new package.

Example: `php artisan package:new Melihovv SomeAwesomePackage`

This command will:

* Create `packages/melihovv/some-awesome-package` folder
* Register package in app composer.json
* Copy package skeleton from skeleton folder to created folder (you can provide
your custom skeleton path in config)
* Run `git init packages/melihovv/some-awesome-package`
* Run `composer update melihovv/some-awesome-package`
* Run `composer dump-autoload`

With interactive `-i` flag you will be prompted for every needed value from you.

### php artisan package:remove {vendor} {package}

Remove the existing package.

Example: `php artisan package:remove Melihovv SomeAwesomePackage`

This command will:

* Run `composer remove melihovv/some-awesome-package`
* Remove `packages/melihovv/some-awesome-package` folder
* Unregister package in app composer.json
* Run `composer dump-autoload`

Interactive mode also possible.

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

## Things you need to do manually:

* In README.md:
  * StyleCI repository identifier
  * Package description
  * Usage section

## Security

If you discover any security related issues, please email amelihovv@ya.ru instead of using the issue tracker.

## Credits

- [Alexander Melihov](https://github.com/melihovv)
- [All contributors](https://github.com/melihovv/laravel-package-generator/graphs/contributors)
