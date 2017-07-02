<?php echo "<?php\n"; ?>

namespace <?php echo $vendor; ?>\<?php echo $package; ?>\Facades;

use Illuminate\Support\Facades\Facade;

class <?php echo $package ?> extends Facade
{
    protected static function getFacadeAccessor()
    {
        return '<?php echo $aliasName; ?>';
    }
}
