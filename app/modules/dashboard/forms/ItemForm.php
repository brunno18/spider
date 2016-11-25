<?php

namespace Spider\Modules\Dashboard\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class ItemForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {

        if (!isset($options['edit'])) {
            $element = new Text("category_id");
            $this->add($element->setLabel("category_id"));
        } else {
            $this->add(new Hidden("category_id"));
        }

        $name = new Text("name");
        $name->setLabel("Nome");
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nome é obrigatório'
            ))
        ));
        $this->add($name);
        
        $price = new Text("price");
        $price->setLabel("Price");
        $this->add($price);
        
        $amount = new Text("amount");
        $amount->setLabel("Amount");
        $this->add($amount);
        
        $description = new Text("description");
        $description->setLabel("Description");
        $description->setFilters(array('striptags', 'string'));
        $this->add($description);
    }
}