<?php

/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 23/11/2016
 * Time: 21:29
 */

use Spider\Modules\Store\Forms\CadastroForm;
use Spider\Modules\Store\Library\ValidaCPFCNPJ;
use Spider\Models\User;

class CadastroController extends ControllerBase
{
    public function indexAction(){
        $this->view->form = new CadastroForm();
    }

    public function cadastrarAction(){

        if ($this->request->isPost()) {
            //Usa um token para verificar se o post não foi de um site externo
            if ($this->security->checkToken()) {
                $usuario = new User();

                $usuario->name = $this->request->getPost('nome', 'string');
                $usuario->email = $this->request->getPost('email', 'email');
                $usuario->password = $this->request->getPost('senha', 'string');
                $usuario->csenha = $this->request->getPost('csenha', 'string');
                $usuario->cpf_cnpj = $this->request->getPost('cpf_cnpj', 'string');
                $usuario->data_criacao = date('Y-m-d');
                $usuario->idRole = 5;
                $usuario->active = 1;

                $go = $this->checarDadosUsuario($usuario);

                //Dados corretos?
                if ($go === true) {
                    //Faz o hash da senha usando hash do phalcon(BCRYPT)
                    $usuario->password = $this->security->hash($usuario->password);
                    if ($usuario->save()) {
                        $this->view->sucesso = true;
                        $this->view->mensagem = 'Cadastrado!Você pode se logar agora!';
                        $this->dispatcher->forward(array(
                            'controller' => 'index',
                            'action' => 'index'
                        ));
                        return;
                    } else {
                        $this->view->cadastroErro = true;
                        $this->view->mensagem = 'Ocorreu um erro ao fazer o cadastro!Tente novamente ou contate o administrador!</br>';
                        foreach ($usuario->getMessages() as $message) {
                            $this->view->mensagem .= $message . '</br>';
                        }
                        $this->dispatcher->forward(array(
                            'controller' => 'cadastro',
                            'action' => 'index'
                        ));
                        return;
                    }
                }

                $this->view->cadastroAviso = true;
                $this->view->mensagem = $go['mensagem'];
                $this->dispatcher->forward(array(
                    'controller' => 'cadastro',
                    'action' => 'index'
                ));
                return;
            }
        }
    }

    private function checarDadosUsuario($usuario){

        if((!isset($usuario->name) || trim($usuario->name)==='') ||
            (!isset($usuario->email) || trim($usuario->email)==='') ||
            (!isset($usuario->password) || trim($usuario->password)==='') ||
            (!isset($usuario->csenha) || trim($usuario->csenha)==='') ||
            (!isset($usuario->cpf_cnpj) || trim($usuario->cpf_cnpj)==='')){
            return array('mensagem' => 'Preencha todos os dados!');
        }

        if(strlen($usuario->name) > 50){
            return array('mensagem' => 'Seu nome deve ter no máximo 50 caracteres.');
        }

        if(strlen($usuario->email) > 180){
            return array('mensagem' => 'Seu email deve ter no máximo 180 caracteres.');
        }

        if(strlen($usuario->password) < 6 || strlen($usuario->password) > 50){
            return array('mensagem' => 'Sua senha deve ter de 6 a 50 caracteres.');
        }

        if(strcmp($usuario->password, $usuario->csenha) != 0){
            return array('mensagem' => 'As senhas digitadas não são iguais.');
        }

        $cc = new ValidaCPFCNPJ($usuario->cpf_cnpj);
        $formatado = $cc->formata();

        if (!$formatado) {
            return array('mensagem' => 'CPF ou CNPJ inválido!');
        }

        return true;
    }
}