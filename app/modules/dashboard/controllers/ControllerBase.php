<?php

namespace Spider\Modules\Dashboard\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $controllerName = $dispatcher->getControllerName();
        $actionName = $dispatcher->getActionName();
        
        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName, $actionName)) {
            $dispatcher->forward([
                'module' => 'dashboard',
                'controller' => 'errors',
                'action' => 'show401'
            ]);
        }
    }
}
