<?php

namespace App\app\controller;

use App\Core\Controller\AbstractController;
use App\Core\Router\Route;

/**
 * Class HomeController
 */
class HomeController extends AbstractController
{
    #[Route(path: '/home', method: ['GET'])]
    public function HelloWorld(): void
    {
        $this->render(['item' => 'World!'], 'home/home');
    }
}