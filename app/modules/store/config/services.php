<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Security;


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

$di->set('security', function () {

    $security = new Security();

    // Hash das senhas cadastradas(Mudar conforme a capacidade do servidor)
    $security->setWorkFactor(12);

    return $security;
}, true);

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    if (!$session->isStarted()) {
        $session->start();
    }

    return $session;
});