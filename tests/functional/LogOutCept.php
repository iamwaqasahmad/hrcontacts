<?php
/**
 * @var \Codeception\Scenario $scenario
 */
$I = new FunctionalTester($scenario);
$I->wantTo('logout from site');
$I->haveInSession('auth', [
    'id'   => 1,
    'name' => 'Phalcon Demo'
]);
$I->amOnPage('/session/end');
$I->see('Account');
$I->seeInCurrentUrl('/session/end');