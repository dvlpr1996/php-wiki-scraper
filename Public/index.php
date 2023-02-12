<?php

use app\Core\Config\Config;

require_once __DIR__ . '/../App/Bootstrap/init.php';


dd((new Config)->get('app.app_name'));
