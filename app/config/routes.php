<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->setDefaultModule("store");

require_once APP_PATH . '/modules/store/config/routes.php';

require_once APP_PATH . '/modules/dashboard/config/routes.php';

return $router;