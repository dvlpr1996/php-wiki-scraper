<?php

return [
    'base_folder' => realpath(BASE_APP_PATH . 'public/'),
    'main_method' => 'index',
    'paths' => [
        'controllers' => realpath(BASE_APP_PATH . 'App/Controllers/')
    ],
    'namespaces' => [
        'controllers' => 'app\Controllers'
    ],
    'debug' => $_ENV['ROUTER_DEBUG']
];
