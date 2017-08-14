1.  Register global middlewear in file app/Http/Kernel.php 

protected $middleware = [
        .............................
        \Crumby\CanonicalHreflang\Middleware\CanonicalHreflangMiddleware::class
    ];
    
2. Register service and facade. 
File: config/app.php

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
      
3. You may disable multilangular and change file config/canonical-hreflang.php 
    'multilangular' => false
    It will prevent from adding hreflang links to head.
     