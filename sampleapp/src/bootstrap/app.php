<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Fix for Vercel read-only filesystem
if (isset($_ENV['VERCEL'])) {
    $cachePath = '/tmp/bootstrap-cache';
    
    // Create cache directory if it doesn't exist
    if (!is_dir($cachePath)) {
        mkdir($cachePath, 0755, true);
    }
    
    // Set cache directory to writable location
    $_ENV['APP_SERVICES_CACHE'] = $cachePath.'/services.php';
    $_ENV['APP_PACKAGES_CACHE'] = $cachePath.'/packages.php';
    $_ENV['APP_CONFIG_CACHE'] = $cachePath.'/config.php';
    $_ENV['APP_ROUTES_CACHE'] = $cachePath.'/routes.php';
    $_ENV['APP_EVENTS_CACHE'] = $cachePath.'/events.php';
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
    })
    
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
