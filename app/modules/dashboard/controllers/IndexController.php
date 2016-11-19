<?php

namespace Spider\Modules\Dashboard\Controllers;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->response->redirect('dashboard/session/login');
    }
}
