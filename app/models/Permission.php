<?php

namespace PsPedidos\Models;

class Permission extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $idRole;

    /**
     *
     * @var string
     */
    public $module;
    
    /**
     *
     * @var string
     */
    public $resource;

    /**
     *
     * @var string
     */
    public $action;

}
