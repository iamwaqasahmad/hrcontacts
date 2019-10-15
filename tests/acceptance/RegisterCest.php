<?php
use League\FactoryMuffin\Faker\Facade as Faker;

class RegisterCest
{

    public function _before(AcceptanceTester $I)
    {
    }
    public function ValidRegistrationDetails(AcceptanceTester $I){

        $I->wantTo('Register as regular user');

        $I->amOnPage('/');
        $I->click('Account');
        $I->seeInCurrentUrl('/session/index');

        $I->see('Log In', "//*[@id='login-header']");
        $I->see("Don't have an account yet?", "//*[@id='signup-header']");

        $I->fillField('registration_name',    'testingwaq');
        $I->fillField('registration_username', $this->_generateEmailAddress());
        $I->fillField('registration_email',    $this->_generateEmailAddress());
        $I->fillField('registration_password', 'test123');
        $I->fillField('registration_repeatPassword', 'test123');

        $I->click('Register');
        $I->seeInCurrentUrl('/session/index');

        $I->see('You are succesfully registered please login now.');

    }

    public function NotValidRegistrationDetails(AcceptanceTester $I){

        $I->wantTo('Register with wrong Details');

        $I->amOnPage('/');
        $I->click('Account');
        $I->seeInCurrentUrl('/session/index');

        $I->see('Log In', "//*[@id='login-header']");
        $I->see("Don't have an account yet?", "//*[@id='signup-header']");

        $I->fillField('registration_name',    'testingwaq');
        $I->fillField('registration_username', $this->_generateEmailAddress());
        $I->fillField('registration_email',    'iam@waqasahmad.net');
        $I->fillField('registration_password', 'test123');
        $I->fillField('registration_repeatPassword', 'test123');

        $I->click('Register');
        $I->seeInCurrentUrl('/session/index');

        $I->see(' Sorry, The email was registered by another user');

    }

    public function _generateEmailAddress()
    {
        $char = "0123456789abcdefghijklmnopqrstuvwxyz";

            $ulen = mt_rand(5, 10);
            $a = "";
            for ($i = 1; $i <= $ulen; $i++)
            {
                $a .= substr($char, mt_rand(0, strlen($char)), 1);
            }
            $a .= "@test.com";
            //echo $a . "\n"
            return $a;
    }

}
