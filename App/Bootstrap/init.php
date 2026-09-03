<?php

declare(strict_types=1);

use app\Core\Adapter\DotEnvAdapter;
use app\Core\Adapter\RouterAdapter;

define('BASE_APP_PATH', dirname(__DIR__, 2) . '/');

$devMode = false;

ini_set('display_errors', $devMode ? '1' : '0');
ini_set('display_startup_errors', $devMode ? '1' : '0');
ini_set('log_errors', '0');
error_reporting($devMode ? E_ALL : 0);
set_error_handler(function () use ($devMode) {
    return $devMode ? false : true;
});

require_once realpath(BASE_APP_PATH . 'vendor/autoload.php');

$dotEnvRequiredElement = [
    'BASE_URL',
    'ROUTER_DEBUG',
];

$dotenv = DotEnvAdapter::getInstance(BASE_APP_PATH);
$dotenv->requiredElement($dotEnvRequiredElement);

$constantsPath = BASE_APP_PATH . 'app/Helpers/constants.php';

if (!file_exists($constantsPath) || !is_file($constantsPath)) {
    http_response_code(500);
    die('Critical Error: Initial constants file does not exist or is not a valid file.');
}

require_once $constantsPath;

$router = RouterAdapter::getInstance();
