<?php

use Phalcon\Mvc\Router\Group;

$dashboard = new Group(array(
    'module' => 'dashboard'
));

$dashboard->setPrefix('/dashboard');

$dashboard->add("(/*)", array(
    'controller' => 'index',
    'action'     => 'index'
));

$dashboard->add("/:controller/*", array(
    'controller' => 1,
));

$dashboard->add("/:controller/:action/*", array(
    'controller' => 1,
    'action'     => 2
));

$dashboard->add("/:controller/:action/:params/*", array(
    'controller' => 1,
    'action'     => 2,
    'params'     => 3
));

$router->mount($dashboard);