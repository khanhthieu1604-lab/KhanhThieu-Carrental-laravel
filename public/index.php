<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));



if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}



require __DIR__.'/../vendor/autoload.php';



$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);


try {
    $response = $kernel->handle(
        $request = Request::capture()
    );
    
    $response->send();
    
    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    
    echo "<div style='background: #ffebee; color: #b71c1c; padding: 20px; border: 2px solid red; font-family: monospace;'>";
    echo "<h1>🔥 LỖI BẮT ĐƯỢC:</h1>";
    echo "<h3>" . $e->getMessage() . "</h3>";
    echo "<p><strong>File:</strong> " . $e->getFile() . " (Line: " . $e->getLine() . ")</p>";
    echo "<hr>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
    die();
}
