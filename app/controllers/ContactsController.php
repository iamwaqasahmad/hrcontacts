<?php

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
        
    }


}
