<?php
namespace App\Test\Unit\Models;
use UnitTester;
use Codeception\Test\Unit;
use Hrcontacts\Models\Users;
use Phalcon\Db\RawValue;
class UsersTest extends Unit
{
    /**
     * The Users model.
     * @var Users
     */
    protected $user;
    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;


    protected function _before()
    {
        $this->user = new Users;
    }
    public function testCreateUser()
    {
        $this->user->name = 'waqas';
        $this->user->username = $this->generateEmailAddress();
        $this->user->email = $this->generateEmailAddress();
        $this->user->password = 'abc123';
        $this->user->created_at = new RawValue('NOW()');
        $this->user->active = 'Y';
        $this->user->save();
        $added = Users::findFirstById($this->user->id);
        $this->assertEquals($this->user->name, $added->name);

    }
    public function testUpdateUser()
    {
        $this->testCreateUser();
        $this->user->name = 'changed name';
        $this->user->save();
        $this->assertEquals('changed name', $this->user->name);

    }

    public function testDeleteUser(){
        $this->testCreateUser();
        $user = Users::findFirstById($this->user->id);
        $user->delete();
        $this->assertEquals(0, Users::findFirstById($this->user->id));

    }
    public function generateEmailAddress()
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