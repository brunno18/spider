<?php

namespace Spider\Modules\Dashboard\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends Form
{

    public function initialize()
    {
        // Username
        $username = new Text('username', [
            'placeholder' => 'Usuário'
        ]);
        
        $username->addValidators([
            new PresenceOf([
                'message' => 'O usuário é obrigatório'
            ])
        ]);
        
        $this->add($username);
        
        // Password
        $password = new Password('password', [
            'placeholder' => 'Senha'
        ]);
        
        $password->addValidator(new PresenceOf([
            'message' => 'O password é obrigatório'
        ]));
        
        $password->clear();
        
        $this->add($password);
        
        // Remember
        $remember = new Check('remember', [
            'value' => 'yes'
        ]);
        
        $remember->setLabel('Continuar conectado');
        
        $this->add($remember);
        
        $this->add(new Submit('Entrar', [
            'class' => 'btn btn-primary btn-block btn-flat'
        ]));
    }
}
