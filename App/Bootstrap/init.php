<?php

use app\Core\Adapter\DotEnvAdapter;
use app\Core\Adapter\RouterAdapter;

define('BASE_APP_PATH', __DIR__ . '/../../');

require_once realpath(BASE_APP_PATH . 'vendor/autoload.php');

(new DotEnvAdapter(BASE_APP_PATH))->requiredElement();

require_once BASE_APP_PATH . 'App/helpers/constants.php';
require_once BASE_APP_PATH . 'Config/error.php';

$router = new RouterAdapter;
