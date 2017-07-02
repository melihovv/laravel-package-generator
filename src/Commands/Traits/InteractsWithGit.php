<?php

namespace Melihovv\LaravelPackageGenerator\Commands\Traits;

use Illuminate\Support\Facades\File;
use Melihovv\LaravelPackageGenerator\Exceptions\RuntimeException;

trait InteractsWithGit
{
    /**
     * Clone repo.
     *
     * @param $url
     * @param $dest
     * @param $branch
     *
     * @throws RuntimeException
     */
    protected function cloneRepo($url, $dest, $branch)
    {
        $command = "git clone --branch=$branch $url $dest";
        $this->info("Run \"$command\".");

        File::makeDirectory($dest, 0755, true);

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
