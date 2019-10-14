<?php 

class FrontendCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Home');
    }
    public function aboutpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('About');
        $I->see('About Contacts List');
    }
    public function loginpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('LogIn');
        $I->see('Login');
        $I->see('Register');
    }

}
