<?php

namespace app\Core\Adapter;

use Buki\Router\Router;

class RouterAdapter
{
    private $router;
    private array $config;

    public function __construct()
    {
        $this->config = config('route');
        $this->router = new Router($this->config);
    }

    public function get(string $route, array $action, string $routeName)
    {
        return $this->router->GET($route, $action, ['name' => $routeName]);
    }

    public function post(string $route, array $action, string $routeName)
    {
        return $this->router->POST($route, $action, ['name' => $routeName]);
    }

    public function routerConfig(): array
    {
        return $this->config;
    }

    public function getAllRoutes()
    {
        return $this->router->getRoutes();
    }

    public function runRouter()
    {
        $this->dispatch404();
        $this->displayError();
        return $this->router->run();
    }

    private function dispatch404()
    {
        return $this->router->notFound(function () {
            header("HTTP/1.0 404 Not Found");
            die('404');
        });
    }

    private function displayError()
    {
        return $this->router->error(function () {
            die('somethings wrong');
        });
    }
}
