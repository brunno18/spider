<?php

namespace Spider\Modules\Dashboard\Libraries\Auth;

use Spider\Models\User;
use Spider\Models\Role;
use Spider\Models\FailedLogins;
use Spider\Models\SuccessLogins;
use Spider\Models\RememberTokens;

use Phalcon\Mvc\User\Component;

/**
 * Spider\Auth\Auth
 * Manages Authentication/Identity Management in Vokuro
 */
class Auth extends Component
{
    /**
     * Checks the user credentials
     *
     * @param array $credentials
     * @return boolean
     * @throws Exception
     */
    public function check($credentials)
    {
        // Check if the user exist
        $user = User::findFirstByUsername($credentials['username']);
        if ($user == false) {
            $this->registerUserThrottling(0);
            throw new Exception('Usuário ou senha inválido.');
        }
        
        // Check the password
        if (!User::comparePassword($credentials['password'], $user->password)) {
            $this->registerUserThrottling($user->idUser);
            throw new Exception('Usuário ou senha inválido.');
        }
        
        // Check if the user was flagged
        $this->checkUserFlags($user);
        
        // Register the successful login
        $this->saveSuccessLogin($user);
        
        // Check if the remember me was selected
        if (isset($credentials['remember'])) {
            
            $this->createRememberEnvironment($user);
        }
        
        $this->session->set('auth-identity', [
            'id' => $user->idUser,
            'name' => $user->name,
            'role' => $user->role->name
        ]);
    }

    /**
     * Creates the remember me environment settings the related cookies and generating tokens
     *
     * @param \Vokuro\Models\Users $user
     * @throws Exception
     */
    public function saveSuccessLogin($user)
    {
        $successLogin = new SuccessLogins();
        $successLogin->idUser = $user->id;
        $successLogin->ipAddress = $this->request->getClientAddress();
        $successLogin->userAgent = $this->request->getUserAgent();
        $successLogin->date = time();
        if (!$successLogin->save()) {
            $messages = $successLogin->getMessages();
            throw new Exception($messages[0]);
        }
    }

    /**
     * Implements login throttling
     * Reduces the effectiveness of brute force attacks
     *
     * @param int $idUser
     */
    public function registerUserThrottling($idUser)
    {
        $failedLogin = new FailedLogins();
        $failedLogin->idUser = $idUser;
        $failedLogin->ipAddress = $this->request->getClientAddress();
        $failedLogin->attempted = time();
        $failedLogin->save();

        $attempts = FailedLogins::count([
            'ipAddress = ?0 AND attempted >= ?1',
            'bind' => [
                $this->request->getClientAddress(),
                time() - 3600 * 6
            ]
        ]);

        switch ($attempts) {
            case 1:
            case 2:
                // no delay
                break;
            case 3:
            case 4:
                sleep(2);
                break;
            default:
                sleep(4);
                break;
        }
    }

    /**
     * Creates the remember me environment settings the related cookies and generating tokens
     *
     * @param \Vokuro\Models\Users $user
     */
    public function createRememberEnvironment(User $user)
    {
        $userAgent = $this->request->getUserAgent();
        $token = md5($user->email . $user->password . $userAgent);

        $remember = new RememberTokens();
        $remember->idUser = $user->idUser;
        $remember->token = $token;
        $remember->userAgent = $userAgent;
        
        if (!$remember->save()) {
            $expire = time() + 86400 * 8;
            setcookie('RMU', $user->idUser, $expire, '/');
            setcookie('RMT', $token, $expire, '/');
        }
    }

    /**
     * Check if the session has a remember me cookie
     *
     * @return boolean
     */
    public function hasRememberMe()
    {
        return isset($_COOKIE['RMU']);
    }

    /**
     * Logs on using the information in the cookies
     *
     * @return \Phalcon\Http\Response
     */
    public function loginWithRememberMe()
    {
        $idUser = $_COOKIE['RMU'];
        $cookieToken = $_COOKIE['RMT'];

        $user = User::findFirstByIdUser($idUser);
        if ($user) {

            $userAgent = $this->request->getUserAgent();
            $token = md5($user->email . $user->password . $userAgent);

            if ($cookieToken == $token) {

                $remember = RememberTokens::findFirst([
                    'idUser = ?0 AND token = ?1',
                    'bind' => [
                        $user->idUser,
                        $token
                    ]
                ]);
                if ($remember) {

                    // Check if the cookie has not expired
                    if ((time() - (86400 * 8)) < $remember->createdAt) {

                        // Check if the user was flagged
                        $this->checkUserFlags($user);

                        // Register identity
                        $this->session->set('auth-identity', [
                            'id' => $user->idUser,
                            'name' => $user->name,
                            'role' => $user->role->name
                        ]);

                        // Register the successful login
                        $this->saveSuccessLogin($user);

                        return $this->response->redirect('dashboard/index');
                    }
                }
            }
        }

        setcookie("RMU", "", time() - 3600, '/');
        setcookie("RMT", "", time() - 3600, '/');

        return $this->response->redirect('dashboard/session/login');
    }

    /**
     * Checks if the user is banned/inactive/suspended
     *
     * @param \Vokuro\Models\Users $user
     * @throws Exception
     */
    public function checkUserFlags(User $user)
    {
        if ($user->active != 1) {
            throw new Exception('O usuário foi desativado');
        }
    }

    /**
     * Returns the current identity
     *
     * @return array
     */
    public function getIdentity()
    {
        return $this->session->get('auth-identity');
    }

    /**
     * Returns the current identity
     *
     * @return string
     */
    public function getName()
    {
        $identity = $this->session->get('auth-identity');
        return $identity['name'];
    }

    /**
     * Removes the user identity information from session
     */
    public function remove()
    {
        if (isset($_COOKIE['RMU'])) {
            setcookie("RMU", "", time() - 3600, '/');
        }
        
        if (isset($_COOKIE['RMT'])) {
            setcookie("RMT", "", time() - 3600, '/');
        }
        
        $this->session->remove('auth-identity');
    }

    /**
     * Auths the user by his/her id
     *
     * @param int $id
     * @throws Exception
     */
    public function authUserById($id)
    {
        $user = User::findFirstByIdUser($id);
        if ($user == false) {
            throw new Exception('The user does not exist');
        }

        $this->checkUserFlags($user);

        $this->session->set('auth-identity', [
            'id' => $user->idUser,
            'name' => $user->name,
            'role' => $user->role->name
        ]);
    }

    /**
     * Get the entity related to user in the active identity
     *
     * @return \Vokuro\Models\Users
     * @throws Exception
     */
    public function getUser()
    {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['id'])) {

            $user = User::findFirstByIdUser($identity['id']);
            if ($user == false) {
                throw new Exception('The user does not exist');
            }

            return $user;
        }

        return false;
    }
}