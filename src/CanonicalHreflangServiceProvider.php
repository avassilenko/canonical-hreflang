<?php
namespace Crumby\CanonicalHreflang;

use Illuminate\Support\ServiceProvider;

class CanonicalHreflangServiceProvider extends ServiceProvider
{
    const CANONICAL_HREFLANG_VAR_NAME = 'CanonicalHreflang';
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(self::CANONICAL_HREFLANG_VAR_NAME, function ($app) {
            $canonicalHreflang = new CanonicalHreflang();

            \View::share(self::CANONICAL_HREFLANG_VAR_NAME, $canonicalHreflang);
            return $canonicalHreflang;
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/crumby-crumbs/canonical-hreflang.php' => config_path('crumby-crumbs/canonical-hreflang.php')
            ], 'config');
        }
        
        $this->app->alias(self::CANONICAL_HREFLANG_VAR_NAME, 'Crumby\CanonicalHreflang\CanonicalHreflang');
        \CanonicalHreflang::loadConfig();
    }
}
