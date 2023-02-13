<?php

use app\Controllers\ActionController;
use app\Controllers\CrawlerController;

$router->get('/', [ActionController::class, 'index'], 'index');
$router->post('/crawler', [CrawlerController::class, 'crawler'], 'crawler');

$router->runRouter();
