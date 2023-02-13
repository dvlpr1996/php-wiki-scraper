<?php

return [
    'base_folder' => realpath(APP_BASE_PATH . 'public'),
    'main_method' => 'index',
    'paths' => [
        'controllers' => realpath(APP_BASE_PATH . 'App/Controllers')
    ],
    'namespaces' => [
        'controllers' => 'app\Controllers'
    ],
    'debug' => $_ENV['ROUTER_DEBUG']
];
