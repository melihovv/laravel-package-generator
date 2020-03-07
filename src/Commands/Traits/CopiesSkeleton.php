<?php

namespace Melihovv\LaravelPackageGenerator\Commands\Traits;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\Engines\PhpEngine;
use Melihovv\LaravelPackageGenerator\Exceptions\RuntimeException;

trait CopiesSkeleton
{
    use InteractsWithUser;

    protected $packageBaseDir = __DIR__.'/../../..';

    /**
     * Copy skeleton to package folder.
     *
     * @param string $packagePath
     * @param string $vendor
     * @param string $package
     * @param string $vendorFolderName
     * @param string $packageFolderName
     *
     * @throws RuntimeException
     */
    protected function copySkeleton(
        $packagePath,
        $vendor,
        $package,
        $vendorFolderName,
        $packageFolderName
    ) {
        $this->info('Copy skeleton.');

        $skeletonDirPath = $this->getPathFromConfig(
            'skeleton_dir_path', $this->packageBaseDir.'/skeleton'
        );

        foreach (File::allFiles($skeletonDirPath, true) as $filePath) {
            $filePath = realpath($filePath);

            $destFilePath = Str::replaceFirst(
                $skeletonDirPath, $packagePath, $filePath
            );

            $this->copyFileWithDirsCreating($filePath, $destFilePath);
        }

        $this->copyStubs($packagePath, $package, $packageFolderName);

        $variables = $this->getVariables(
            $vendor, $package, $vendorFolderName, $packageFolderName
        );
        $this->replaceTemplates($packagePath, $variables);

        $this->info('Skeleton was successfully copied.');
    }

    /**
     * Copy stubs.
     *
     * @param $packagePath
     * @param $package
     * @param $packageFolderName
     */
    protected function copyStubs($packagePath, $package, $packageFolderName)
    {
        $facadeFilePath = $this->packageBaseDir.'/stubs/Facade.php.tpl';
        $mainClassFilePath = $this->packageBaseDir.'/stubs/MainClass.php.tpl';
        $mainClassTestFilePath = $this->packageBaseDir.'/stubs/MainClassTest.php.tpl';
        $configFilePath = $this->packageBaseDir.'/stubs/config.php';

        $filePaths = [
            $facadeFilePath => "$packagePath/src/Facades/$package.php.tpl",
            $mainClassFilePath => "$packagePath/src/$package.php.tpl",
            $mainClassTestFilePath => "$packagePath/tests/{$package}Test.php.tpl",
            $configFilePath => "$packagePath/config/$packageFolderName.php",
        ];

        foreach ($filePaths as $filePath => $destFilePath) {
            $this->copyFileWithDirsCreating($filePath, $destFilePath);
        }
    }

    /**
     * Substitute all variables in *.tpl files and remove tpl extension.
     *
     * @param string $packagePath
     * @param array $variables
     */
    protected function replaceTemplates($packagePath, $variables)
    {
        $phpEngine = app()->make(PhpEngine::class);

        foreach (File::allFiles($packagePath, true) as $filePath) {
            $filePath = realpath($filePath);

            if (! Str::endsWith($filePath, '.tpl')) {
                continue;
            }

            try {
                $newFileContent = $phpEngine->get($filePath, $variables);
            } catch (Exception $e) {
                $this->error("Template [$filePath] contains syntax errors");
                $this->error($e->getMessage());
                continue;
            }

            $filePathWithoutTplExt = Str::replaceLast(
                '.tpl', '', $filePath
            );

            File::put($filePathWithoutTplExt, $newFileContent);
            File::delete($filePath);
        }
    }

    /**
     * Copy source file to destination with needed directories creating.
     *
     * @param string $src
     * @param string $dest
     */
    protected function copyFileWithDirsCreating($src, $dest)
    {
        $dirPathOfDestFile = dirname($dest);

        if (! File::exists($dirPathOfDestFile)) {
            File::makeDirectory($dirPathOfDestFile, 0755, true);
        }

        if (! File::exists($dest)) {
            File::copy($src, $dest);
        }
    }

    /**
     * Get variables for substitution in templates.
     *
     * @param string $vendor
     * @param string $package
     * @param string $vendorFolderName
     * @param string $packageFolderName
     *
     * @return array
     */
    protected function getVariables(
        $vendor,
        $package,
        $vendorFolderName,
        $packageFolderName
    ) {
        $packageWords = str_replace('-', ' ', Str::snake($packageFolderName));

        $composerDescription = $this->askUser(
            'The composer description?', "A $packageWords"
        );
        $composerKeywords = $this->getComposerKeywords($packageWords);

        $packageHumanName = $this->askUser(
            'The package human name?', Str::title($packageWords)
        );

        return [
            'vendor' => $vendor,
            'package' => $package,
            'vendorFolderName' => $vendorFolderName,
            'packageFolderName' => $packageFolderName,
            'packageHumanName' => $packageHumanName,

            'composerName' => "$vendorFolderName/$packageFolderName",
            'composerDesc' => $composerDescription,
            'composerKeywords' => $composerKeywords,
            'license' => $this->askUser('The package licence?', 'MIT'),
            'phpVersion' => $this->askUser('Php version constraint?', '>=7.2'),

            'aliasName' => $packageFolderName,
            'configFileName' => $packageFolderName,

            'year' => date('Y'),

            'name' => $this->askUser('Your name?'),
            'email' => $this->askUser('Your email?'),
            'githubPackageUrl' => "https://github.com/$vendorFolderName/$packageFolderName",
        ];
    }

    /**
     * Get path from config.
     *
     * @param string $configName
     * @param string $default
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected function getPathFromConfig($configName, $default)
    {
        $path = config("package-generator.$configName");

        if (empty($path)) {
            $path = $default;
        } else {
            $path = base_path($path);
        }

        $realPath = realpath($path);

        if ($realPath === false) {
            throw RuntimeException::noAccessTo($path);
        }

        return $realPath;
    }

    /**
     * Get composer keywords.
     *
     * @param $packageWords
     *
     * @return string
     */
    protected function getComposerKeywords($packageWords)
    {
        $keywords = $this->askUser(
            'The composer keywords? (comma delimited)', str_replace(' ', ',', $packageWords)
        );
        $keywords = explode(',', $keywords);
        $keywords = array_map(function ($keyword) {
            return "\"$keyword\"";
        }, $keywords);

        return implode(",\n".str_repeat(' ', 4), $keywords);
    }
}
