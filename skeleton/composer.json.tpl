{
  "name": "<?php echo $composerName; ?>",
  "description": "<?php echo $composerDesc; ?>",
  "license": "<?php echo $license; ?>",
  "keywords": [
    <?php echo "$composerKeywords\n"; ?>
  ],
  "type": "library",
  "authors": [
    {
      "name": "<?php echo $name; ?>",
      "email": "<?php echo $email; ?>"
    }
  ],
  "require": {
    "php": "<?php echo $phpVersion; ?>",
    "illuminate/support": "~5.8.0"
  },
  "require-dev": {
    "orchestra/testbench": "~3.8.0",
    "phpunit/phpunit": "^7.0"
  },
  "autoload": {
    "psr-4": {
      "<?php echo $vendor; ?>\\<?php echo $package; ?>\\": "src"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "<?php echo $vendor; ?>\\<?php echo $package; ?>\\Tests\\": "tests"
    },
    "files": [
      "vendor/phpunit/phpunit/src/Framework/Assert/Functions.php"
    ]
  },
  "scripts": {
    "phpunit": "phpunit"
  },
  "extra": {
    "laravel": {
      "providers": [
        "<?php echo $vendor; ?>\\<?php echo $package; ?>\\ServiceProvider"
      ]
    }
  },
  "config": {
    "preferred-install": "dist",
    "sort-packages": true,
    "optimize-autoloader": true
  }
}
