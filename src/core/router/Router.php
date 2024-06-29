<?php

namespace App\Core\Router;

use http\Exception\BadUrlException;

class Router
{
    private array $routes = [];
    private ?object $controller = null;
    private ?string $action = null;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function matchMethodAndRoute(string $requestPath, string $requestMethod): void
    {
        foreach ($this->routes as $route) {
            if (
                $route['path'] === $requestPath
                && in_array($requestMethod, $route['method'])
            ) {
                $this->controller = $route['controller'];
                $this->action = $route['action'];
            }
        }
    }


    public function run(): void
    {
        if ($this->controller === null || $this->action === null) {
            throw new BadUrlException('No route found', 404);
        }

        try {
            $this->controller->{$this->action}();
        } catch (\Exception $e) {
            throw new BadUrlException('Error executing action', 500, $e);
        }
    }
}
