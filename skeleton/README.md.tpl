# <?php echo "$packageHumanName\n"; ?>

[![Build Status](https://travis-ci.org/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>.svg?branch=master)](https://travis-ci.org/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>)
[![styleci](https://styleci.io/repos/CHANGEME/shield)](https://styleci.io/repos/CHANGEME)
[![Packagist](https://img.shields.io/packagist/v/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>.svg)](https://packagist.org/packages/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>)
[![Packagist](https://poser.pugx.org/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>/d/total.svg)](https://packagist.org/packages/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>)
[![Packagist](https://img.shields.io/packagist/l/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>.svg)](https://packagist.org/packages/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>)

Package description: CHANGE ME

## Installation

Install via composer
```
composer require <?php echo $vendorFolderName; ?>/<?php echo "$packageFolderName\n"; ?>
```

### Register Service Provider

**Note! This and next step are optional if you use laravel>=5.5 with package
auto discovery feature.**

Add service provider to `config/app.php` in `providers` section
```php
<?php echo $vendor; ?>\<?php echo $package; ?>\ServiceProvider::class,
```

### Register Facade

Register package facade in `config/app.php` in `aliases` section
```php
<?php echo $vendor; ?>\<?php echo $package; ?>\Facades\<?php echo $package; ?>::class,
```

### Publish Configuration File

```
php artisan vendor:publish --provider="<?php echo $vendor; ?>\<?php echo $package; ?>\ServiceProvider" --tag="config"
```

## Usage

CHANGE ME

## Security

If you discover any security related issues, please email <?php echo "$email\n"; ?>
instead of using the issue tracker.

## Credits

- [<?php echo $name; ?>](<?php echo $githubPackageUrl; ?>)
- [All contributors](<?php echo $githubPackageUrl; ?>/graphs/contributors)
