<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $moduleConfig->application->controllersDir,
        $moduleConfig->application->formsDir,
        $moduleConfig->application->libraryDir
    )
);

$loader->registerNamespaces(
    array(
        'Spider\Modules\Store\Forms' => $moduleConfig->application->formsDir,
        'Spider\Modules\Store\Library' => $moduleConfig->application->libraryDir
    )
);

$loader->register();