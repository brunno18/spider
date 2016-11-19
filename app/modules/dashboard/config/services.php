<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Dispatcher;

use Spider\Modules\Dashboard\Libraries\Acl\Acl;
use Spider\Modules\Dashboard\Libraries\Auth\Auth;


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

// Registering a dispatcher
$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();

    //Dispatcher use a default namespace
    $dispatcher->setDefaultNamespace('Spider\Modules\Dashboard\Controllers');

    return $dispatcher;
});

/**
 * Access Control List
 */
$di->set('acl', function () {
    return new Acl();
});

/**
 * Custom authentication component
 */
$di->set('auth', function () {
    return new Auth();
});