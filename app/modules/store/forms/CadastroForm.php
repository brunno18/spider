<?php

/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 04/02/2016
 * Time: 18:21
 */

namespace Spider\Modules\Store\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;

class CadastroForm extends Form
{
    public function initialize(){
        $nome = new Text('nome', array(
            'placeholder' => 'Nome',
            'class' => 'form-control',
            'id' => 'nome',
            'required' => ''
        ));
        $nome->addValidators(array(new PresenceOf(array(
            'message' => 'Campo NOME � um campo obrigatorio'
        ))));
        $this->add($nome);

        $email = new Text('email', array(
            'placeholder' => 'Email',
            'class' => 'form-control',
            'id' => 'email',
            'required' => ''
        ));
        $email->addValidators(array(new PresenceOf(array(
            'message' => 'Campo EMAIL � um campo obrigatorio'
        ))));
        $this->add($email);

        $senha = new Password('senha', array(
            'placeholder' => 'Senha',
            'class' => 'form-control',
            'id' => 'senha',
            'required' => ''
        ));
        $senha->addValidators(array(new PresenceOf(array(
            'message' => 'Campo SENHA � um campo obrigatorio'
        ))));
        $this->add($senha);

        $csenha = new Password('csenha', array(
            'placeholder' => 'Confirmar senha',
            'class' => 'form-control',
            'id' => 'csenha',
            'required' => ''
        ));
        $csenha->addValidators(array(new PresenceOf(array(
            'message' => 'Campo SENHA � um campo obrigatorio'
        ))));
        $this->add($csenha);

        $cpf_cnpj = new Text('cpf_cnpj', array(
            'placeholder' => 'CPF ou CNPJ',
            'class' => 'form-control',
            'id' => 'cpf_cnpj',
            'required' => ''
        ));
        $cpf_cnpj->addValidators(array(new PresenceOf(array(
            'message' => 'Campo CPF ou CNPJ � um campo obrigatorio'
        ))));
        $this->add($cpf_cnpj);
    }
}