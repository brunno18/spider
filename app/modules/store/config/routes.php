<?php

use Phalcon\Mvc\Router\Group;

$store = new Group(array(
    'module' => 'store'
));

$store->setPrefix('/store');

$store->add("(/*)", array(
    'controller' => 'index',
    'action'     => 'index'
));

$store->add("/:controller/*", array(
    'controller' => 1,
));

$store->add("/:controller/:action/*", array(
    'controller' => 1,
    'action'     => 2
));

$store->add("/:controller/:action/:params/*", array(
    'controller' => 1,
    'action'     => 2,
    'params'     => 3
));

$router->mount($store);