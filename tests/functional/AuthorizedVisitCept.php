<?php
/**
 * @var \Codeception\Scenario $scenario
 */
$I = new FunctionalTester($scenario);
$I->wantTo('perform login as first user');
$I->haveInSession('auth', [
    'id'   => 1,
    'name' => 'Waqas Ahmad'
]);
$I->amOnPage('/');
$I->see('contacts');
$I->see('Log Out');