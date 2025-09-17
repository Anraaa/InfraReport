<?php

require __DIR__.'/../vendor/autoload.php';

// Handle Vercel read-only filesystem
$cachePath = '/tmp/bootstrap-cache';
if (!is_dir($cachePath)) {
    mkdir($cachePath, 0755, true);
}

// Set environment variables for cache paths
putenv('APP_SERVICES_CACHE='.$cachePath.'/services.php');
putenv('APP_PACKAGES_CACHE='.$cachePath.'/packages.php');
putenv('APP_CONFIG_CACHE='.$cachePath.'/config.php');
putenv('APP_ROUTES_CACHE='.$cachePath.'/routes.php');
putenv('APP_EVENTS_CACHE='.$cachePath.'/events.php');

// Load Laravel application
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);