<?php


use Hrcontacts\Models\Users;

class ProfileController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Profile');

        parent::initialize();
    }

    /**
     * Edit the active user profile
     */
    public function editAction()
    {
        // Get session info
        $auth = $this->session->get('auth');

        /** @var Users $user */
        $user = Users::findFirst($auth['id']);

        if ($user == false) {
            return $this->forward('index/index');
        }

        if (!$this->request->isPost()) {
            $this->tag->setDefault('name', $user->name);
            $this->tag->setDefault('email', $user->email);
            $this->tag->setDefault('password', '');
        } else {
            $name = $this->request->getPost('name', array('string', 'striptags'));
            $email = $this->request->getPost('email', 'email');
            $password = ($this->request->getPost('password') != '') ?  $this->request->getPost('password') : $user->password;

            $user->name = $name;
            $user->email = $email;
            $user->password = sha1($password);

            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->flash->success('Your profile information was updated successfully');

                $auth = [
                    'id'   => $user->id,
                    'name' => $user->name
                ];

                $this->session->set('auth', $auth);
            }
        }
    }
}
