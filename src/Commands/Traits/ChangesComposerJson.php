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

        if (! isset($composerJson['repositories'])) {
            array_set($composerJson, 'repositories', []);
        }

        $filtered = array_filter($composerJson['repositories'], function ($repository) use ($relPackagePath) {
            return $repository['type'] === 'path'
                && $repository['url'] === $relPackagePath;
        });

        if (count($filtered) === 0) {
            $this->info('Register composer repository for package.');

            $composerJson['repositories'][] = (object) [
                'type' => 'path',
                'url' => $relPackagePath,
            ];
        } else {
            $this->info('Composer repository for package is already registered.');
        }

        array_set($composerJson, "require.$vendor/$package", 'dev-master');

        $this->saveComposerJson($composerJson);

        $this->info('Package was successfully registered in composer.json.');
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
    protected function unregisterPackage($vendor, $package, $relPackagePath)
    {
        $this->info('Unregister package from composer.json.');

        $composerJson = $this->loadComposerJson();

        unset($composerJson['require']["$vendor\\$package\\"]);

        $repositories = array_filter($composerJson['repositories'], function ($repository) use ($relPackagePath) {
            return $repository['type'] !== 'path'
                || $repository['url'] !== $relPackagePath;
        });

        $composerJson['repositories'] = $repositories;

        if (count($composerJson['repositories']) === 0) {
            unset($composerJson['repositories']);
        }

        $this->saveComposerJson($composerJson);

        $this->info('Package was successfully unregistered from composer.json.');
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
