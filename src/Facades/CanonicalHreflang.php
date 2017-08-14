<?php
namespace Crumby\CanonicalHreflang\Facades;

use Illuminate\Support\Facades\Facade;

class CanonicalHreflang extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CanonicalHreflang';
    }
}
