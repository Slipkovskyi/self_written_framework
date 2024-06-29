<?php

use App\Core\Router\Route;

class HomeController
{
    #[Route(path: '/home', method: ['GET'])]
    public function HelloWorld(): void
    {
        echo '<h1>Hello World</h1>';
    }
}