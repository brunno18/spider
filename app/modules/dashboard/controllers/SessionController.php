<?php

namespace Spider\Modules\Dashboard\Controllers;

use Spider\Modules\Dashboard\Forms\LoginForm;
use Spider\Modules\Dashboard\Forms\ForgotPasswordForm;
use Spider\Modules\Dashboard\Libraries\Auth\Exception as AuthException;
use Spider\Models\User;
use Spider\Models\ResetPassword;

class SessionController extends ControllerBase
{
    public function indexAction()
    {
        $this->response->redirect('dashboard/session/login');
    }
    
    /**
     * Starts a session in the admin backend
     */
    public function loginAction()
    {
        $form = new LoginForm();
        
        try {
           
            if (!$this->request->isPost()) {
                
                if ($this->auth->hasRememberMe()) {
                    return $this->auth->loginWithRememberMe();
                }
            } else {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flashSession->error($message);
                    }
                } else {
                    
                    $this->auth->check([
                        'username' => $this->request->getPost('username'),
                        'password' => $this->request->getPost('password'),
                        'remember' => $this->request->getPost('remember')
                    ]);
                    
                    return $this->response->redirect('dashboard/index');
                }
            }
        } catch (AuthException $e) {
            $this->flashSession->error($e->getMessage());
        }
        
        $this->view->form = $form;
    }
    
    /**
     * Handle forgot password
     */
    public function forgotPasswordAction()
    {
        $form = new ForgotPasswordForm();
        
        if ($this->request->isPost()) {
            
            // Send emails only is config value is set to true
            if ($this->moduleConfig->mail->active) {

                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flashSession->error($message);
                    }
                } else {
                    
                    $user = User::findFirstByUsername($this->request->getPost('username'));
                    if (!$user) {
                        $this->flashSession->warning('Não foi encontrada nenhuma conta com esse nome de usuário');
                    } else {
                        
                        $resetPassword = new ResetPassword();
                        $resetPassword->idUser = $user->idUser;
                        if ($resetPassword->save()) {
                            $this->flashSession->success('Sucesso! Uma mensagem foi enviada para o email associado a sua conta.');
                        } else {
                            foreach ($resetPassword->getMessages() as $message) {
                                $this->flashSession->error($message);
                            }
                        }
                    }
                }
            } else {
                $this->flashSession->warning('O envio de emails está desativado. Contate o administrador.');
            }
        }
        
        $this->view->form = $form;
    }
    
    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();
        
        return $this->response->redirect('dashboard/session/login');
    }
}