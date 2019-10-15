<?php

use UnitTester;
use Codeception\Test\Unit;
use Hrcontacts\Models\Contacts;
use Phalcon\Db\RawValue;


class ContactsTest extends Unit
{
    /**
     * The Users model.
     * @var Users
     */
    protected $contact;
    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;
    protected function _before()
    {
        $this->contact = new Contacts;
    }
    function testCreateContact()
    {
          $this->contact->setUserId(1);
          $this->contact->setFirstName('waqas');
          $this->contact->setLastName('ahmad');
          $this->contact->setEmail('abc@abc.com');
          $this->contact->setPhoneNo('123123');
          $this->contact->create_date = new RawValue('NOW()');
          $this->contact->save();
          $added = Contacts::findFirstById($this->contact->getId());
          $this->assertEquals($this->contact->getFirstName(), $added->getFirstName());

    }
    function testUpdateContact()
    {
        $this->testCreateContact();
        $this->contact->setFirstName('changed first name');
        $this->contact->save();
        $this->assertEquals('changed first name', $this->contact->getFirstName());

    }

    function testDeleteContact(){
        $this->testCreateContact();
        $this->contact->delete();
        $this->assertEquals(0, Contacts::findFirstById($this->contact->getId()));

    }

}