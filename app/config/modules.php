<?php

/**
 * Register application modules
 */
$modules = array(
    'store' => array(
        'className' => 'Module',
        'path' => APP_PATH . 'app/modules/store/Module.php'
    ),
    'dashboard' => array(
        'className' => 'Module',
        'path' => APP_PATH . 'app/modules/dashboard/Module.php'
    )
);