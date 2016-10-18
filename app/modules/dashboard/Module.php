<?php

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $moduleConfig = include __DIR__ . "/config/config.php";
        include __DIR__ . "/config/loader.php";
    }
    
    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {
        $config       = include __DIR__ . "/../../config/config.php";
        $moduleConfig = include __DIR__ . "/config/config.php";
        
        include __DIR__ . "/config/services.php";
    }
}