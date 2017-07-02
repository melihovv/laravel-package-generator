<?php

namespace Melihovv\LaravelPackageGenerator\Commands\Traits;

use Illuminate\Support\Facades\File;
use Melihovv\LaravelPackageGenerator\Exceptions\RuntimeException;

trait ManipulatesPackageFolder
{
    /**
     * Create package folder.
     *
     * @param string $packagePath
     *
     * @throws RuntimeException
     */
    protected function createPackageFolder($packagePath)
    {
        $this->info('Create package folder.');

        if (File::exists($packagePath)) {
            $this->info('Package folder already exists. Skipping.');

            return;
        }

        if (! File::makeDirectory($packagePath, 0755, true)) {
            throw new RuntimeException('Cannot create package folder');
        }

        $this->info('Package folder was successfully created.');
    }

    /**
     * Remove package folder.
     *
     * @param $packagePath
     *
     * @throws RuntimeException
     */
    protected function removePackageFolder($packagePath)
    {
        $this->info('Remove package folder.');

        if (File::exists($packagePath)) {
            if (! File::deleteDirectory($packagePath)) {
                throw new RuntimeException('Cannot remove package folder');
            }

            $this->info('Package folder was successfully removed.');
        } else {
            $this->info('Package folder does not exists. Skipping.');
        }
    }
}
