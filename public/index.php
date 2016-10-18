<?php

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * Read the configuration
     */
    include APP_PATH . "/config/config.php";

    /**
     * Read auto-loader
     */
    include APP_PATH . "/config/loader.php";

    /**
     * Read services
     */
    include APP_PATH . "/config/services.php";
    
    /**
     * Read Modules
     */
    include APP_PATH . "/config/modules.php";
    
    
    $application = new \Phalcon\Mvc\Application($di);
    
    $application->registerModules($modules);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
