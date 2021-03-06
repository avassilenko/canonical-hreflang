Installation:
-------------
```
> composer require crumby/canonical-hreflang
> php artisan vendor:publish --provider="Crumby\CanonicalHreflang\CanonicalHreflangServiceProvider" --tag=config
```

Register service and facade:
----------------------------
File: config/app.php
```
'providers' => [
    ......................
    'Crumby\CanonicalHreflang\CanonicalHreflangServiceProvider',
    ........................
 ];
 
 'aliases' => [ 
    ......................
    'Canonicalhreflang' => 'Crumby\CanonicalHreflang\Facades\CanonicalHreflang',
    ......................
 ];
```

Register global middlewear:
--------------------------
file app/Http/Kernel.php 
```
protected $middleware = [
        .............................
        \Crumby\CanonicalHreflang\Middleware\CanonicalHreflangMiddleware::class
    ];
```
         
Configuration:
--------------
Besides automatically set canonical url links to head, it also sets Hreflang, if unabled.
config/canonical-hreflang.php
```
    'multilangular' => true
```
        
Example:
--------
- add middleware to constructor of your controller
    ```
        class StaticPagesController extends Controller {
            public function __construct()
            {
                ...........................
                $this->middleware('CanonicalHreflang');
                ...........................
            }
        }
    ```

- place this variable to your Blade template head section
    ```
    {!! $CanonicalHreflang !!} 

    ````   

Documentation:
-------------
<a href="https://www.crumby-pack.com/packages/laravel-54-hreflang-canonical-tags">API documentation</a>