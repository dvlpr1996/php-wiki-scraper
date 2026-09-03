<?php

declare(strict_types=1);

$bootstrapPath = __DIR__ . '/../app/Bootstrap/init.php';
$routesPath = __DIR__ . '/../routes/web.php';

if (!file_exists($bootstrapPath) || !is_file($bootstrapPath)) {
    http_response_code(500);
    die('Critical Error: Error bootstrap file does not exist or is not a valid file.');
}

if (!file_exists($routesPath) || !is_file($routesPath)) {
    http_response_code(500);
    die('Critical Error: Error route file does not exist or is not a valid file.');
}

require_once realpath($bootstrapPath);
require_once realpath($routesPath);
