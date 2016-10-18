<?php

/**
 * Register application modules
 */
$modules = array(
    'store' => array(
        'className' => 'Module',
        'path' => APP_PATH . '/modules/store/Module.php'
    ),
    'dashboard' => array(
        'className' => 'Module',
        'path' => APP_PATH . '/modules/dashboard/Module.php'
    )
);