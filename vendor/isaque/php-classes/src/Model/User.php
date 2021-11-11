<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class User extends Model {

    const SESSION   = 'User';
    const ERROR     = 'UserError';

    public static function login($login, $password) {

        $sql = new Sql();

        $results = $sql->select('SELECT * FROM users a INNER JOIN employees b ON (a.employee_id = b.employee_id)  WHERE(a.login = :login);', array(
            ':login'    => $login
        ));

        if(count($results) === 0) {
            throw new \Exception('Incorrect login or password.');
        }
        else {

            $data = $results[0];

            if($password === $data['password']) {

                $user = new User();

                $user->setValues($data);

                $_SESSION[User::SESSION] = $user->getValues();
            }
            else {
                throw new \Exception('Incorrect login or password.');
            }
        }
    }

    public static function checkLogin() {

        if(
            (!isset($_SESSION[User::SESSION])) ||
            (!$_SESSION[User::SESSION]) ||
            (!(int)$_SESSION[User::SESSION]['user_id'] > 0)
        ) {
            return false;
        }
        else {

            return true;
        }
    }

    public static function verifyLogin() {

        if(User::checkLogin() === false) {

            header('Location: /login');
            die;
        }
    }

    public static function logout() {

        $_SESSION[User::SESSION]    = NULL;
    }
}
?>