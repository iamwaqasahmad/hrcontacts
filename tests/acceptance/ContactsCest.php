<?php
use Codeception\Util\Locator;


class ContactsCest
{
    public $email = 'iam@waqasahmad.net';
    public $password = 'waqas123';

    protected $fake_email;

    public function _before(AcceptanceTester $I)
    {

    }
    public function createContactsAcceptance(AcceptanceTester $I){
        $I->wantTo('Create a new contact');

        $I->amOnPage('/');
        $I->click('Account');
        $I->seeInCurrentUrl('/session/index');

        $I->see('Log In', "//*[@id='login-header']");
        $I->see("Don't have an account yet?", "//*[@id='signup-header']");

        $I->fillField('email',    $this->email);
        $I->fillField('password', $this->password);

        $I->click('Login');
        $I->seeInCurrentUrl('/session/start');

        //$I->see('Welcome to HRcontacts List');
        $I->seeLink('Log Out');

        $I->click('Create Contacts');
        $I->seeInCurrentUrl('/contacts/new');

        $I->fillField('first_name',    'waqas');
        $I->fillField('last_name', 'acceptance');
        $I->fillField('phone_no',    'acceptance@waqas.com');
        $I->fillField('email', 'email@test.com');

        $I->click('Save');

        $I->see('Contacts was created successfully');
    }
    public function editContactsAcceptance(AcceptanceTester $I){
        $I->wantTo('update a contact');
        $I->amOnPage('/');
        $I->click('Account');
        $I->seeInCurrentUrl('/session/index');

        $I->see('Log In', "//*[@id='login-header']");
        $I->see("Don't have an account yet?", "//*[@id='signup-header']");

        $I->fillField('email',    'demo@phalconphp.com');
        $I->fillField('password', 'phalcon');

        $I->click('Login');
        $I->seeInCurrentUrl('/session/start');
        $I->amOnPage('/contacts/index/');
        $I->seeLink('Log Out');
        $I->click('.edit');
        $I->see("Edit contacts");
        $I->fillField('first_name',    'edit waqas');
        $I->fillField('last_name', 'edit acceptance');
        $I->fillField('phone_no',    'acceptance@waqas.com');
        $I->fillField('email', 'email@test.com');
        $I->click('Save');
        $I->seeInCurrentUrl('/contacts/save');
        $I->see('contacts was updated successfully');


    }



}