<?php

namespace Melihovv\LaravelPackageGenerator\Commands\Traits;

use Melihovv\LaravelPackageGenerator\Exceptions\RuntimeException;

trait InteractsWithComposer
{
    /**
     * Run "composer dump-autoload".
     *
     * @throws RuntimeException
     */
    protected function composerDumpAutoload()
    {
        $command = 'composer dump-autoload';
        $this->info("Run \"$command\".");

        $output = [];
        exec($command, $output, $returnStatusCode);

        if ($returnStatusCode !== 0) {
            throw RuntimeException::commandExecutionFailed(
                $command, $returnStatusCode
            );
        }

        $this->info("\"$command\" was successfully ran.");
    }
}
