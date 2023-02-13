<?php

use app\Controllers\ActionController;

$route->get('/', [ActionController::class, 'index'], 'index');
$route->post('/crawler', [ActionController::class, 'crawler'], 'crawler');

