<?php

namespace Spider\Models;

use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Item extends \Phalcon\Mvc\Model
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
    public $category_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var integer
     */
    public $amount;

    /**
     *
     * @var double
     */
    public $price;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo("category_id",  __NAMESPACE__ . "\Category", "id", [
            'alias' => 'category'
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
            new PresenceOf(array(
                'field' => 'name',
                'message' => 'O nome do item é obrigatório'
            ))
        );
        
        $this->validate(
            new Uniqueness(array(
                'field' => ['name', 'category_id'],
                'message' => 'Já existe um item com o nome - ' . $this->name
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
        return 'item';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Item[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Item
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
