<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model\User;

class UserTest extends TestCase {

    public function testGetAUserFromDatabase() {

        $user = new User();

        $user->get('4');

        $expected = array(
            'user_id'       => '4',
            'employee_id'   => '8',
            'login'         => 'joao',
            'password'      => '$2y$12$MV1gD3Qn0RoGBzaxAbTx.eAjiLo45OekKFrk.vedkQswYWoqIIfUW',
            'dtregister'    => '2021-11-13 16:57:03'
        );

        $this->assertEquals($expected, $user->getValues());
    }

    public function testUserLogin() {

        $user = new User();

        $this->assertEquals('', $user->login('joao', 'root'));
    }

    public function testCheckIfTheUserIsLoggedIn() {

        $user = new User();

        $user->login('joao', 'root');

        $this->assertEquals(true, User::checkLogin());
    }

    public function testUserLogout() {

        $user = new User();

        $user->login('joao', 'root');

        $user->logout();

        $this->assertEquals(NULL, $_SESSION[User::SESSION]);
    }
}
?>