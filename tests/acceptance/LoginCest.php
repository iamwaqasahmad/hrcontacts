<?php 

class LoginCest
{

    public $email = 'iam@waqasahmad.net';
    public $password = 'waqas123';

    public function _before(AcceptanceTester $I)
    {
    }


    public function invalidLoginDetails(AcceptanceTester $I){

        $I->wantTo('login with invalid password and see banner');
        $I->amOnPage('/');
        $I->click('Account');
        $I->seeInCurrentUrl('/session/index');
        $I->fillField('email',    $this->email);
        $I->fillField('password', 'invalid');
        $I->click('Login');
        $I->seeInCurrentUrl('/session/start');
        $I->see('Wrong email/password');
        $I->dontSee('Log Out');
    }

    public function CorrectLoginDetails(AcceptanceTester $I){

        $I->wantTo('login as regular user');

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

    }

    public function Logout(AcceptanceTester $I){
        $I->wantTo('logout from site');
        $I->amOnPage('/session/index');
        $I->see('Log In', "//*[@id='login-header']");
        $I->see("Don't have an account yet?", "//*[@id='signup-header']");

        $I->fillField('email',     $this->email);
        $I->fillField('password', $this->password);

        $I->click('Login');
        $I->seeInCurrentUrl('/session/start');

        $I->seeLink('Log Out');
        $I->click('Log Out');
        $I->see('Account');
        $I->seeInCurrentUrl('/session/end');
    }
}
