<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

$app->withFacades();

$app->withEloquent();

$app->configure('database');

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/
//interfaces
$app->bind('App\Interfaces\UserInterface', 'App\Repositories\UserRepository');
$app->bind('App\Interfaces\PasswordEncInterface', 'App\Services\Password_hasher');
$app->bind('App\Interfaces\JwtInterface', 'App\Services\Jwt');
$app->bind('App\Interfaces\RoleInterface', 'App\Repositories\RoleRepository');
$app->bind('App\Interfaces\SubordinatesInterface', 'App\Repositories\SubordinatesRepository');
$app->bind('App\Interfaces\MailerInterface', 'App\Services\Mailer');
$app->bind('App\Interfaces\PassGeneratorInterface', 'App\Services\PassGenerator');
$app->bind('App\Interfaces\PermissionsValidatorInterface', 'App\Services\PermissionsValidator');
$app->bind('App\Interfaces\dateCalculatorInterface', 'App\Services\dateCalculator');
$app->bind('App\Interfaces\WeekRepoInterface', 'App\Repositories\WeekRepo');
$app->bind('App\Interfaces\weekFillServiceInterface', 'App\Services\weekFillService');
$app->bind('App\Interfaces\DayRepoInterface', 'App\Repositories\DayRepo');

//
//middleware
// $app->middleware([
//     App\Http\Middleware\TokenMiddleware::class
//  ]);
$app->routeMiddleware([
    'TokenMiddleware' => App\Http\Middleware\TokenMiddleware::class,
]);
$app->routeMiddleware([
    'CoordinatorValidation' => App\Http\Middleware\CoordinatorValidation::class,
]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);
//
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);
$app->register(Illuminate\Redis\RedisServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//    App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
