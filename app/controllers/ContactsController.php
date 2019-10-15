<?php


use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Hrcontacts\Forms\ContactsForm;
use Hrcontacts\Models\Contacts;

/**
 * ContactsController
 *
 * Manage CRUD operations for Contacts
 */
class ContactsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your Contacts');

        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->set('conditions', null);
        $numberPage = 1;
        $user_id = $this->session->get('auth')['id'];
        if ($this->request->isPost()) {
            $values = $this->request->getPost();
            $values['user_id'] = $user_id;
            $query = Criteria::fromInput($this->di, 'Hrcontacts\Models\Contacts', $values);
            $this->persistent->set('searchParams', $query->getParams());
        } else {
            $values['user_id'] = $user_id;
            $query = Criteria::fromInput($this->di, 'Hrcontacts\Models\Contacts', $values);
            $this->persistent->set('searchParams', $query->getParams());
            $numberPage = $this->request->getQuery("page", "int");
        }
        $parameters = $this->persistent->get('searchParams', []);

        $contacts = Contacts::find(
                    $parameters
        );

        $paginator = new Paginator([
            'data'  => $contacts,
            'limit' => 3,
            'page'  => $numberPage
        ]);

        $this->view->setVar('page', $paginator->getPaginate());

    }

    /**
     * Search contacts based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Hrcontacts\Models\Contacts', $this->request->getPost());
            $this->persistent->set('searchParams', $query->getParams());


        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->get('searchParams', []);


        $parameters['conditions'] = ($parameters['conditions'] == '' ? '[user_id] = :user_id:' : '[user_id] = :user_id: AND' .$parameters['conditions']);
        $parameters['bind']['user_id'] =  $this->session->get('auth')['id'];
        $contacts = Contacts::find($parameters);

        if (!$contacts->count()) {
            $this->flash->notice("The search did not find any Contacts");
            return $this->forward("contacts/index");
        }

        $paginator = new Paginator([
            'data'  => $contacts,
            'limit' => 10,
            'page'  => $numberPage
        ]);

        $this->view->setVar('page', $paginator->getPaginate());
    }

    /**
     * Shows the form to create a new contact
     */
    public function newAction()
    {
        $this->view->setVar('form', new ContactsForm(null, ['edit' => false]));
    }

    /**
     * Edits a contact based on its id
     * @param int $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $contacts = Contacts::findFirstById($id);
            if (!$contacts) {
                $this->flash->error('Contacts was not found');
                return $this->forward("contacts/index");
            }

            $this->view->setVar('form', new ContactsForm($contacts, ['edit' => true]));
        }
    }

    /**
     * Creates a new contact
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("contacts/index");
        }

        $form = new ContactsForm;
        $contact = new Contacts;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $contact)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('contacts/new');
        }

        if ($contact->save() == false) {
            foreach ($contact->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('contacts/new');
        }

        $form->clear();

        $this->flash->success("Contacts was created successfully");
        return $this->forward("contacts/index");
    }

    /**
     * Saves current contact in screen
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("contacts/index");
        }

        $id = $this->request->getPost("id", "int");

        $contacts = Contacts::findFirstById($id);
        if (!$contacts) {
            $this->flash->error("Contact does not exist");
            return $this->forward("contacts/index");
        }

        $form = new ContactsForm;
        $this->view->setVar('form', $form);

        $data = $this->request->getPost();

        if (!$form->isValid($data, $contacts)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('contacts/edit/' . $id);
        }

        if ($contacts->save() == false) {
            foreach ($contacts->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('contacts/edit/' . $id);
        }

        $form->clear();

        $this->flash->success('contacts was updated successfully');
        return $this->forward("contacts/index");
    }

    /**
     * Deletes a contact
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $contacts = Contacts::findFirstById($id);
        if (!$contacts) {
            $this->flash->error("Contact was not found");
            return $this->forward("contacts/index");
        }

        if (!$contacts->delete()) {
            foreach ($contacts->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("contacts/search");
        }

        $this->flash->success("Contact was deleted");
        return $this->forward("contacts/index");
    }
}
