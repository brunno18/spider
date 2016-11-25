<?php

namespace Spider\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class User extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $role_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $username;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=25, nullable=true)
     */
    public $phone;

    /**
     *
     * @var string
     * @Column(type="string", length=25, nullable=true)
     */
    public $cellphone;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    public $active;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=false)
     */
    public $cpf_cnpj;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $data_criacao;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        return true;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("User");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'User';
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

}
