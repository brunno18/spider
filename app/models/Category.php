<?php

namespace Spider\Models;

use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Category extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idCategory;

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
     * Initialize method for model.
     */
    public function initialize()
    {   
        $this->hasMany("idCategory",  __NAMESPACE__ . "\Item", "idCategory", [
            'alias' => 'items',
            "foreignKey" => [
                "message" => "Essa categoria não pode ser removida por que há produtos nela.",
            ]
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
                'field' => ['name'],
                'message' => 'Já existe uma categoria com o nome - ' . $this->name
            ))
        );
        
        $this->validate(
            new PresenceOf(array(
                'field' => 'name',
                'message' => 'O nome da categoria é obrigatório'
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
        return 'category';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Category[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Category
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
