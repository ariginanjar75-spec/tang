<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Tentukan root path
$rootPath = __DIR__ . '/..';

// Autoload
require $rootPath . '/vendor/autoload.php';

// Bootstrap
$app = require_once $rootPath . '/bootstrap/app.php';

// Jalankan aplikasi
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
