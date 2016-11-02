<?php

namespace Spider\Models;

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

        public function initialize()
    {
        $this->belongsTo("idRole",  __NAMESPACE__ . "\Role", "id", [
            'alias' => 'role'
        ]);
    }
    
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'permission';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Permission[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Permission
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
