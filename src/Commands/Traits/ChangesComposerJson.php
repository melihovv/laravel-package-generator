<?php

namespace Melihovv\LaravelPackageGenerator\Commands\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Melihovv\LaravelPackageGenerator\Exceptions\RuntimeException;

trait ChangesComposerJson
{
    /**
     * Register package in composer.json.
     *
     * @param $vendor
     * @param $package
     * @param $relPackagePath
     *
     * @throws RuntimeException
     */
    protected function registerPackage($vendor, $package, $relPackagePath)
    {
        $this->info('Register package in composer.json.');

        $composerJson = $this->loadComposerJson();

        if (! isset($composerJson['autoload'])) {
            $composerJson['autoload'] = [];
        }

        if (! isset($composerJson['autoload']['psr-4'])) {
            $composerJson['autoload']['psr-4'] = [];
        }

        if (isset($composerJson['autoload']['psr-4']["$vendor\\$package\\"])) {
            $this->info('Package auto loading was already configured. Skipping.');

            return;
        }

        $composerJson['autoload']['psr-4']["$vendor\\$package\\"] = $relPackagePath;

        $this->saveComposerJson($composerJson);

        $this->info('Package auto loading was successfully configured.');
    }

    /**
     * Unregister package from composer.json.
     *
     * @param $vendor
     * @param $package
     *
     * @throws FileNotFoundException
     * @throws RuntimeException
     */
    protected function unregisterPackage($vendor, $package)
    {
        $this->info('Unregister package from composer.json.');

        $composerJson = $this->loadComposerJson();

        if (! isset($composerJson['autoload'], $composerJson['autoload']['psr-4'])) {
            $this->info('Auto loading is not configured in composer.json. Skipping.');

            return;
        }

        unset($composerJson['autoload']['psr-4']["$vendor\\$package\\"]);

        $this->saveComposerJson($composerJson);

        $this->info('Package was successfully removed from composer.json.');
    }

    /**
     * Load and parse content of composer.json.
     *
     * @return array
     *
     * @throws FileNotFoundException
     * @throws RuntimeException
     */
    protected function loadComposerJson()
    {
        $composerJsonPath = $this->getComposerJsonPath();

        if (! File::exists($composerJsonPath)) {
            throw new FileNotFoundException('composer.json does not exist');
        }

        $composerJsonContent = File::get($composerJsonPath);
        $composerJson = json_decode($composerJsonContent, true);

        if (! is_array($composerJson)) {
            throw new RuntimeException("Invalid composer.json file [$composerJsonPath]");
        }

        return $composerJson;
    }

    /**
     * @param array $composerJson
     *
     * @throws RuntimeException
     */
    protected function saveComposerJson($composerJson)
    {
        $newComposerJson = json_encode(
            $composerJson,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );

        $composerJsonPath = $this->getComposerJsonPath();
        if (File::put($composerJsonPath, $newComposerJson) === false) {
            throw new RuntimeException("Cannot write to composer.json [$composerJsonPath]");
        }
    }

    /**
     * Get composer.json path.
     *
     * @return string
     */
    protected function getComposerJsonPath()
    {
        return base_path('composer.json');
    }
}
