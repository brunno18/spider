<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;


$di->set('moduleConfig', function () use ($moduleConfig) {
    return $moduleConfig;
});


/**
 * Setting up the view component
 */
$di->set('view', function () use ($moduleConfig) {
    
    $view = new View();
    
    $view->setViewsDir($moduleConfig->application->viewsDir);
    
    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($moduleConfig) {
            
            $volt = new VoltEngine($view, $di);
            
            $volt->setOptions(array(
                'compiledPath' => $moduleConfig->application->cacheDir,
                'stat' => true,
                'compileAlways' => true ,
                'compiledSeparator' => '_'
            ));
            
            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));
    
    return $view;
});