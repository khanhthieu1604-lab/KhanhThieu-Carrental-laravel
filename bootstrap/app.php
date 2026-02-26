<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Web middleware stack
        $middleware->web(append: [
            \App\Http\Middleware\Localization::class,
        ]);

        // Middleware aliases
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // Throttle groups for rate limiting
        $middleware->alias([
            'throttle.booking' => \Illuminate\Routing\Middleware\ThrottleRequests::class . ':10,1',
            'throttle.payment' => \Illuminate\Routing\Middleware\ThrottleRequests::class . ':5,1',
            'throttle.review' => \Illuminate\Routing\Middleware\ThrottleRequests::class . ':3,1',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();
