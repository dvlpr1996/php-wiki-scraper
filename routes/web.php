<?php

use app\Controllers\ActionController;

$route->get('/', [ActionController::class, 'index'], 'index');
$route->get('/home', [ActionController::class, 'home'], 'home');
$route->post('/crawler', [ActionController::class, 'crawler'], 'crawler');

