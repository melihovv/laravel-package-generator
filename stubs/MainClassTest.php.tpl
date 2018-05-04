<?php echo "<?php\n"; ?>

namespace <?php echo $vendor; ?>\<?php echo $package; ?>\Tests;

use <?php echo $vendor; ?>\<?php echo $package; ?>\Facades\<?php echo $package; ?>;
use <?php echo $vendor; ?>\<?php echo $package; ?>\ServiceProvider;
use Orchestra\Testbench\TestCase;

class <?php echo $package; ?>Test extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            '<?php echo $aliasName; ?>' => <?php echo $package; ?>::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
