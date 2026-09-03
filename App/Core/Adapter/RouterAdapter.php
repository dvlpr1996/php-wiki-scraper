<?php

namespace app\Core\Adapter;

use Buki\Router\Router;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RouterAdapter
{
    private static ?RouterAdapter $instance = null;

    private Router $router;
    private array $config;

    private function __construct()
    {
        $this->config = config('route');
        $this->router = new Router($this->config);
    }

    public static function getInstance(): RouterAdapter
    {
        if (self::$instance === null) {
            self::$instance = new RouterAdapter();
        }
        return self::$instance;
    }

    public function get(string $route, array $action, string $routeName): void
    {
        $this->router->GET($route, $action, ['name' => $routeName]);
    }

    public function post(string $route, array $action, string $routeName): void
    {
        $this->router->POST($route, $action, ['name' => $routeName]);
    }

    public function routerConfig(): array
    {
        return $this->config;
    }

    public function getAllRoutes(): array
    {
        return $this->router->getRoutes();
    }

    public function runRouter(): void
    {
        $this->dispatch404();
        $this->displayError();
        $this->router->run();
    }

    private function dispatch404(): void
    {
        $this->router->notFound(function () {
            header("HTTP/1.0 404 Not Found");
            die('404 - Page Not Found');
        });
    }

    private function displayError(): void
    {
        $this->router->error(function (Request $request, Response $response, Exception $exception) {
            return view('index', ['validation_errors' => $exception->getMessage()]);
        });
    }
}
