<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;

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

/**
 * Register the flash service with custom CSS classes
 */
$di->set(
    "flash",
    function () {
        $flash = new FlashDirect(
            [
                "error"   => "alert alert-danger",
                "success" => "alert alert-success",
                "notice"  => "alert alert-info",
                "warning" => "alert alert-warning",
            ]
        );
        
        return $flash;
    }
);


/**
 * Register the flash service with custom CSS classes
 */
$di->set(
    "flashSession",
    function () {
        $flashSession = new FlashSession(
            [
                "error"   => "alert alert-danger",
                "success" => "alert alert-success",
                "notice"  => "alert alert-info",
                "warning" => "alert alert-warning",
            ]
        );  
        
        return $flashSession;
    }
);