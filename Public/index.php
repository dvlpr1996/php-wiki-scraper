<?php

require_once realpath(__DIR__ . '/../App/Bootstrap/init.php');
require realpath(__DIR__ . '/../routes/web.php');

$route->runRouter();
