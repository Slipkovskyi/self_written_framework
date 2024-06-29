<?php

namespace App\Core\Router;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class ControllerFinder
{
    private string $dir;
    private array $controllersPaths = [];

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function findControllerPaths(): void
    {
        $phpFiles = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->dir));
        foreach ($iterator as $file) {
            if (
                $file->isFile()
                && $file->getExtension() === 'php'
                && str_contains($file->getFilename(), 'Controller')
            ) {
                $phpFiles[] = $file->getPathname();
            }
        }
        $this->controllersPaths = $phpFiles;
    }

    public function paths(): array
    {
        return $this->controllersPaths;
    }
}
