<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 24/11/2016
 * Time: 14:01
 */

use Spider\Models\User;

class SessionController extends ControllerBase
{
    public function indexAction(){
        
    }

    /**
     * Autenticação e login no sistema
     */
    public function startAction(){

        if ($this->request->isPost()) {
            //Usa um token para verificar se o post não foi de um site externo
            if ($this->security->checkToken()) {
                $email = $this->request->getPost('email', 'email');
                $senha = $this->request->getPost('senha', 'string');

                $usuario = User::findFirst(
                    array(
                        "email = :email:",
                        'bind' => array(
                            'email' => $email
                        )
                    )
                );

                //Retornou um usuário?
                if ($usuario != false) {
                    //Usuário ativo?
                    if ($usuario->active != 0) {
                        //Verifica senha
                        if ($this->security->checkHash($senha, $usuario->password)) {
                            $nome = explode(' ', $usuario->name);
                            $usuario->name = $nome[0];
                            $this->registrarSessao($usuario);
                            $this->view->sucesso = true;
                            $this->view->mensagem = 'Logado.';
                            $this->dispatcher->forward(
                                array(
                                    'controller' => 'index',
                                    'action' => 'index'
                                )
                            );
                            return;
                        }
                        $this->view->loginAviso = true;
                        $this->view->mensagem = 'Senha incorreta.';
                        $this->dispatcher->forward(
                            array(
                                'controller' => 'session',
                                'action' => 'index'
                            )
                        );
                        return;
                    }
                    $this->view->loginAviso = true;
                    $this->view->mensagem = 'Usuário está bloqueado.Contate a administração.';
                    $this->dispatcher->forward(
                        array(
                            'controller' => 'session',
                            'action' => 'index'
                        )
                    );
                    return;
                }
                $this->view->loginAviso = true;
                $this->view->mensagem = 'Usuário não encontrado, verifique se o email está correto.';
                $this->dispatcher->forward(
                    array(
                        'controller' => 'session',
                        'action' => 'index'
                    )
                );
                return;
            }
        }
        $this->dispatcher->forward(
            array(
                'controller' => 'index',
                'action' => 'index'
            )
        );
        return;
    }

    public function endAction()
    {
        $this->session->destroy();
        $this->response->redirect('index');
        $this->response->send();
        return;
    }

    private function registrarSessao(User $usuario){
        $this->session->set('id', $usuario->id);
        $this->session->set('nome', $usuario->name);
        $this->session->set('email', $usuario->email);
        $this->session->set('papel', $usuario->idRole);
        //$grupo = Grupo::findFirst('nome = "'.$usuario->grupo.'"');
        //$this->session->set('papelGrupo', $grupo->papel);
    }
}