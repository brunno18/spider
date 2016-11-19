<?php

namespace Spider\Modules\Dashboard\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    public function initialize(){
        $this->view->baseurl = $this->url->get();
	}
    
    
    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $this->acl->rebuild();
        
        $controllerName = $dispatcher->getControllerName();
        $actionName = $dispatcher->getActionName();
        
        // Get the current identity
        $identity = $this->auth->getIdentity();
        
        $this->view->publicUrl = $this->config->application->publicUrl;
        
        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName, $actionName)) {
            // If there is no identity available the user is redirected to index/index
            if (!is_array($identity)) {
                
                $this->flashSession->warning('Você não tem permissão para acessar esse recurso.');
                
                $this->response->redirect('dashboard/session/login');
                
                return false;
            }
            
            // Check if the user have permission to the current option
            if (!$this->acl->isAllowed($identity['role'], $controllerName, $actionName)) {
                
                $this->flashSession->warning('Você não tem permissão para acessar este modulo: ' . $controllerName . ':' . $actionName);
                
                if ($this->acl->isAllowed($identity['role'], $controllerName, 'index')) {
                    $this->response->redirect("dashboard/$controllerName/index");
                } else {
                    $dispatcher->forward([
                        'module' => 'dashboard',
                        'controller' => 'errors',
                        'action' => 'show401'
                    ]);
                }
                
                return false;
            }
        }
        else {
            if (is_array($identity) and $controllerName != "errors") {
                $this->response->redirect("dashboard/index");
                return false;
            }
        }
    }
    
    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }
}
