<?php 

class LoginCest
{
    public function invalidLoginDetails(AcceptanceTester $I){

        $I->wantTo('login with invalid password and see banner');
        $I->amOnPage('/');
        $I->click('Account');
        $I->seeInCurrentUrl('/session/index');
        $I->fillField('email', 'test');
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

        $I->fillField('registration_name',    'acceptance Test');
        $I->fillField('registration_username', 'acceptancetest');
        $I->fillField('registration_email',    'acceptance@test.com');
        $I->fillField('registration_password', 'test123');
        $I->fillField('registration_repeatPassword', 'test123');

        $I->click('Register');

        $I->amOnPage('/');
        $I->click('Account');
        $I->seeInCurrentUrl('/session/index');

        $I->see('Log In', "//*[@id='login-header']");
        $I->see("Don't have an account yet?", "//*[@id='signup-header']");

        $I->fillField('email',    'acceptance@test.com');
        $I->fillField('password', 'test123');

        $I->click('Login');
        $I->seeInCurrentUrl('/session/start');

        $I->seeLink('Log Out');

    }
}
