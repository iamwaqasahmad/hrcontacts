<?php

use Hrcontacts\Forms\RegisterForm;
use Hrcontacts\Models\Users;
use Phalcon\Db\RawValue;


class SessionController extends controllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Sign Up/Sign In');

        parent::initialize();
    }

    public function indexAction()
    {
        $form = new RegisterForm;
        if ($this->request->isPost()) {
            $name = $this->request->getPost('registration_name', array('string', 'striptags'));
            $username = $this->request->getPost('registration_username', 'alphanum');
            $email = $this->request->getPost('registration_email', 'email');
            $password = $this->request->getPost('registration_password');
            $repeatPassword = $this->request->getPost('registration_repeatPassword');

            if ($password != $repeatPassword) {
                echo $password;
                echo '<br>';
                echo $repeatPassword;
                $this->flash->error('Passwords are different');
                return false;
            }

            $user = new Users;
            $user->username = $username;
            $user->password = sha1($password);
            $user->name = $name;
            $user->email = $email;
            $user->created_at = new RawValue('NOW()');
            $user->active = 'Y';

            if (false == $user->save()) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->tag->setDefault('email', '');
                $this->tag->setDefault('password', '');
                $this->flash->success('Thanks for sign-up, please log-in to start generating invoices');
                return $this->forward('session/acdone');
            }
        }
        $this->view->setVar('form', $form);
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function registerSession(Users $user)
    {
        $this->session->set('auth', [
            'id'   => $user->id,
            'name' => $user->name
        ]);
    }

    public function startAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            /** @var Users $user */
            $user = Users::findFirst(array(
                "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                'bind' => ['email' => $email, 'password' => sha1($password)]
            ));

            if ($user != false) {
                $this->registerSession($user);
                $this->flash->success('Welcome ' . $user->name);
                return $this->forward('contacts/index');
            }

            $this->flash->error('Wrong email/password');
        }

        return $this->forward('session/index');
    }

    /**
     * Finishes the active session redirecting to the index
     */
    public function endAction()
    {
        if ($auth = $this->session->get('auth')) {
            $user = Users::findFirstById($auth['id']);

            $name = $user ? $user->name : '';
            $this->flash->success("Goodbye {$name}!");

            $this->session->remove('auth');
        }

        return $this->forward('index/index');
    }

    public function acdoneAction()
    {

    }

}

