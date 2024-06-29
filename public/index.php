<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router\ControllerFinder;
use App\Core\Router\RouteParser;
use App\Core\Router\Router;

$controllerFinder = new ControllerFinder(dir: '../src/app/controller');
$controllerFinder->findControllerPaths();

$routeParser = new RouteParser($controllerFinder->paths());
try {
    $routeParser->parseRoutes();
} catch (ReflectionException $e) {
    echo $e->getMessage();
    exit;
}

$router = new Router($routeParser->routes());
$router->matchMethodAndRoute(
    requestPath: $_SERVER['REQUEST_URI'],
    requestMethod: $_SERVER['REQUEST_METHOD']
);
$router->run();
