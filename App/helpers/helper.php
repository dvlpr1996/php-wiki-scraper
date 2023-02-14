<?php

use app\Core\Config\Config;
use app\Core\Adapter\BladeViewAdapter;

if (!function_exists('config')) {
    function config(string $key): array|string
    {
        return (new Config)->get($key);
    }
}

if (!function_exists('checkFileExists')) {
    function checkFileExists(string $path): bool
    {
        if (file_exists($path) && is_readable($path)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('view')) {
    function view(string $path, array $data = []): void
    {
        try {
            (new BladeViewAdapter)->display($path, $data);
        } catch (Exception $e) {
            displayError($e);
        }
    }
}

if (!function_exists('route')) {
    function route(string $routeName, array $parameter = [])
    {
        return BASE_URL . getRoute($routeName);
    }
}

if (!function_exists('getRoute')) {
    function getRoute(string $routeName)
    {
        global $router;
        $allRoute = $router->getAllRoutes();
        foreach ($allRoute as $key => $value) {
            if ($value['name'] === $routeName) {
                $route = $value['route'];
            }
        }
        return $route;
    }
}

if (!function_exists('displayError')) {
    function displayError($msg)
    {
        echo "<pre style='color: #9c4100; background: #eee; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #c56705;'>";
        echo $msg;
        echo "</pre>";
    }
}
