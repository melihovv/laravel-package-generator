<?php

namespace Melihovv\LaravelPackageGenerator\Commands\Traits;

use Melihovv\LaravelPackageGenerator\Exceptions\RuntimeException;

trait InteractsWithComposer
{
    /**
     * Run "composer dump-autoload".
     */
    protected function composerDumpAutoload()
    {
        $this->composerRunCommand('composer dump-autoload');
    }

    /**
     * Run "composer update $vendor/$package".
     *
     * @param string $vendor
     * @param string $package
     */
    protected function composerUpdatePackage($vendor, $package)
    {
        $this->composerRunCommand("composer update --ignore-platform-reqs $vendor/$package");
    }

    /**
     * Run "composer remove $vendor/$package".
     *
     * @param string $vendor
     * @param string $package
     */
    protected function composerRemovePackage($vendor, $package)
    {
        $this->composerRunCommand("composer remove --ignore-platform-reqs $vendor/$package");
    }

    /**
     * Run arbitrary composer command.
     *
     * @param $command
     */
    protected function composerRunCommand($command)
    {
        $this->info("Run \"$command\".");

        $output = [];
        exec($command, $output, $returnStatusCode);

        if ($returnStatusCode !== 0) {
            throw RuntimeException::commandExecutionFailed($command, $returnStatusCode);
        }

        $this->info("\"$command\" was successfully ran.");
    }
}
