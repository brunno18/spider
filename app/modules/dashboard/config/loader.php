<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Spider\Modules\Dashboard\Controllers'   => $moduleConfig->application->controllersDir,
    'Spider\Modules\Dashboard\Libraries'     => $moduleConfig->application->libraryDir,
    'Spider\Modules\Dashboard\Forms'         => $moduleConfig->application->formsDir,
]);

$loader->register();