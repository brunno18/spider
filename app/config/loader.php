<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Spider\Models'      => APP_PATH . $config->application->modelsDir
]);

$loader->register();