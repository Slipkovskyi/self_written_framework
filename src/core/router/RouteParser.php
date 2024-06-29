<?php

namespace App\Core\Router;

use ReflectionClass;
use ReflectionException;

class RouteParser
{
    private array $controllerPaths;
    private array $routes;

    public function __construct(array $controllerPaths)
    {
        $this->controllerPaths = $controllerPaths;
    }

    /**
     * @throws ReflectionException
     */
    public function parseRoutes(): void
    {
        $routes = [];
        foreach ($this->controllerPaths as $controllerPath) {
            require_once $controllerPath;
            $controller = pathinfo($controllerPath)['filename'];
            $controller = new $controller();
            $reflection = new ReflectionClass($controller);
            $methods = $reflection->getMethods();

            foreach ($methods as $method) {
                $attributes = $method->getAttributes();
                foreach ($attributes as $attribute) {
                    $attributeName = $attribute->getName();
                    $attributeArgs = $attribute->getArguments();
                    $routes[] = [
                        'path' => $attributeArgs['path'],
                        'method' => $attributeArgs['method'],
                        'controller' => $controller,
                        'action' => $method->getName()
                    ];
                }
            }
        }
        $this->routes = $routes;
    }

    public function routes(): array
    {
        return $this->routes;
    }
}
