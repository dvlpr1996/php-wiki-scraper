<?php

declare(strict_types=1);

define('APP_NAME', 'php wiki scraper');
define('APP_BASE_PATH', dirname(__DIR__, 2) . '/');
define('BASE_URL', $_ENV['BASE_URL']);
define('CONFIG_PATH', APP_BASE_PATH . 'config/');
define('CACHE_PATH', APP_BASE_PATH . 'storage/');
define('VIEW_PATH', APP_BASE_PATH . 'resources/');
