<?php

use App\Core\Controller\AbstractController;
use App\Core\Router\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/home', method: ['GET'])]
    public function HelloWorld(): void
    {
        $this->render(['item' => 'World!'], 'home/home');
    }
}