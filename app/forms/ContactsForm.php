<?php

namespace Hrcontacts\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\Email;

class ContactsForm extends Form
{
    /**
     * Initialize the Contacts form
     *
     * @param mixed $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = null)
    {
        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $first_name = new Text("first_name");
        $first_name->setLabel("First Name");
        $first_name->setFilters(['striptags', 'string']);
        $first_name->addValidators([new PresenceOf(['message' => 'First Name is required'])]);
        $this->add($first_name);

        $last_name = new Text("last_name");
        $last_name->setLabel("Last Name");
        $last_name->setFilters(['striptags', 'string']);
        $last_name->addValidators([new PresenceOf(['message' => 'Last Name is required'])]);
        $this->add($last_name);

        $phone_no = new Text("phone_no");
        $phone_no->setLabel("Phone No");
        $phone_no->setFilters(['striptags', 'string']);
        $phone_no->addValidators([new PresenceOf(['message' => 'Phone No is required'])]);
        $this->add($phone_no);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf(['message' => 'E-mail is required']),
            new Email(['message' => 'E-mail is not valid'])
        ]);
        $this->add($email);


    }
}
