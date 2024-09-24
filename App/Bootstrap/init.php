<?php

use app\Core\Adapter\DotEnvAdapter;
use app\Core\Adapter\RouterAdapter;

define('BASE_APP_PATH', __DIR__ . '/../../');

require_once realpath(BASE_APP_PATH . 'vendor/autoload.php');

$dotEnvRequiredElement = [
    'SITE_TITLE',
    'APP_NAME',
    'BASE_PATH',
    'BASE_URL',
    'ROUTER_DEBUG',
    'DISPLAY_ERRORS',
    'DISPLAY_STARTUP_ERRORS',
    'ERROR_REPORTING'
];

$dotenv = DotEnvAdapter::getInstance(BASE_APP_PATH);
$dotenv->requiredElement($dotEnvRequiredElement);

require_once BASE_APP_PATH . 'App/helpers/constants.php';
require_once BASE_APP_PATH . 'Config/error.php';

$router = RouterAdapter::getInstance();
