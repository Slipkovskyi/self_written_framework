<?php

namespace App\core\controller;

abstract class AbstractController
{
    public function render(array $params, $view)
    {
        extract($params);
        require_once __DIR__ . "/../../app/view/$view.php";
    }
}