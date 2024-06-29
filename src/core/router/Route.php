<?php

namespace App\Core\Router;

use Attribute;

#[Attribute]
class Route
{
    public string $path;
    public array $method;

    public function __construct($path, $method)
    {
        $this->path = $path;
        $this->method = $method;
    }
}