<?php

error_reporting(E_ALL);

try {
    
    define('APP_PATH', realpath('..') . '/');

    /**
     * Read the configuration
     */
    include APP_PATH . "app/config/config.php";

    /**
     * Read auto-loader
     */
    include APP_PATH . "app/config/loader.php";

	//require('vendor/autoload.php');

    /**
     * Read services
     */
    include APP_PATH . "app/config/services.php";
    
    /**
     * Read Modules
     */
    include APP_PATH . "app/config/modules.php";
    
    
    $application = new \Phalcon\Mvc\Application($di);
    
    $application->registerModules($modules);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
