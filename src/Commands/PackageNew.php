<?php

namespace Melihovv\LaravelPackageGenerator\Commands;

use Exception;
use Illuminate\Console\Command;
use Melihovv\LaravelPackageGenerator\Commands\Traits\ChangesComposerJson;
use Melihovv\LaravelPackageGenerator\Commands\Traits\CopiesSkeleton;
use Melihovv\LaravelPackageGenerator\Commands\Traits\InteractsWithComposer;
use Melihovv\LaravelPackageGenerator\Commands\Traits\InteractsWithGit;
use Melihovv\LaravelPackageGenerator\Commands\Traits\ManipulatesPackageFolder;

class PackageNew extends Command
{
    use ChangesComposerJson;
    use ManipulatesPackageFolder;
    use InteractsWithComposer;
    use CopiesSkeleton;
    use InteractsWithGit;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:new
                            {vendor : The vendor part of the namespace}
                            {package : The name of package for the namespace}
                            {--i|interactive : Interactive mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new package.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $vendor = $this->getVendor();
        $package = $this->getPackage();

        $vendorFolderName = $this->getVendorFolderName($vendor);
        $packageFolderName = $this->getPackageFolderName($package);

        $relPackagePath = "packages/$vendorFolderName/$packageFolderName";
        $packagePath = base_path($relPackagePath);

        try {
            $this->createPackageFolder($packagePath);
            $this->registerPackage($vendorFolderName, $packageFolderName, $relPackagePath);
            $this->copySkeleton($packagePath, $vendor, $package, $vendorFolderName, $packageFolderName);
            $this->initRepo($packagePath);
            $this->composerUpdatePackage($vendorFolderName, $packageFolderName);
            $this->composerDumpAutoload();

            $this->info('Finished. Are you ready to write awesome package?');

            return 0;
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return -1;
        }
    }
}
