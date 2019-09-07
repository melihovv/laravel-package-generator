# <?php echo "$packageHumanName\n"; ?>

[![Build Status](https://travis-ci.org/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>.svg?branch=master)](https://travis-ci.org/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>)
[![styleci](https://styleci.io/repos/CHANGEME/shield)](https://styleci.io/repos/CHANGEME)
[![Coverage Status](https://coveralls.io/repos/github/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>/badge.svg?branch=master)](https://coveralls.io/github/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>?branch=master)

[![Packagist](https://img.shields.io/packagist/v/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>.svg)](https://packagist.org/packages/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>)
[![Packagist](https://poser.pugx.org/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>/d/total.svg)](https://packagist.org/packages/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>)
[![Packagist](https://img.shields.io/packagist/l/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>.svg)](https://packagist.org/packages/<?php echo $vendorFolderName; ?>/<?php echo $packageFolderName; ?>)

Package description: CHANGE ME

## Installation

Install via composer
```bash
composer require <?php echo $vendorFolderName; ?>/<?php echo "$packageFolderName\n"; ?>
```

### Publish Configuration File

```bash
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

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
