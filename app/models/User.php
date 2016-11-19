<?php

namespace Spider\Models;

use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\InclusionIn;
use Phalcon\Mvc\Model\Validator\Numericality;

class User extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $active;

    /**
     *
     * @var integer
     */
    public $idRole;
    
    
    /**
     * Define relationships
     */
    public function initialize()
    {
        $this->belongsTo("idRole",  __NAMESPACE__ . "\Role", "id", [
            'alias' => 'role',
            'reusable' => true
        ]);
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->validate(
            new Uniqueness(array(
                'field' => 'username',
                'message' => 'Conflict occurred attempting to store user - Duplicate username Entry'
            ))
        );
        
        $this->validate(
            new PresenceOf(array(
                'field' => 'name',
                'message' => 'name is required'
            ))
        );
        
        $this->validate(
            new PresenceOf(array(
                'field' => 'username',
                'message' => 'username is required'
            ))
        );
        
        $this->validate(
            new PresenceOf(array(
                'field' => 'password',
                'message' => 'password is required'
            ))
        );
        
        $this->validate(
            new PresenceOf(array(
                'field' => 'idRole',
                'message' => 'role is required'
            ))
        );
        
        $this->validate( 
            new InclusionIn(array(
                'field' => 'active',
                'message' => 'Active field must be 0 or 1',
                'domain' => array(0, 1)
            ))
        );
        
        return !$this->validationHasFailed();
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    
    public static function comparePassword($test_pw,$given_hash){
        return true;
    }

}
