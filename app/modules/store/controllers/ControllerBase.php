<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize(){
        $this->view->baseurl = $this->url->get();
    }
}
