<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;
use Isaque\Mailer;

class User extends Model {

    const SESSION   = 'User';
    const ERROR     = 'UserError';
    const SECRET    = 'User_Secret';
    const SECRET_IV = 'User_Secret_IV';

    public static function login($login, $password) {

        $sql = new Sql();

        $results = $sql->select('SELECT
        a.user_id,
        a.login,
        a.password,
        b.fist_name,
        b.last_name,
        c.job_title
        FROM users a
        INNER JOIN employees b ON (a.employee_id = b.employee_id)
        INNER JOIN jobs c ON (b.job_id = c.job_id)
        WHERE(a.login = :login);', array(
            ':login'    => $login
        ));

        if(count($results) === 0) {
            throw new \Exception('Incorrect login or password.');
        }
        else {

            $data = $results[0];

            if(password_verify($password, $data['password'])) {

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

    public static function getForgot($email) {

        $sql = new Sql();

        $results = $sql->select('SELECT *
        FROM users a
        INNER JOIN employees b ON (a.employee_id = b.employee_id)
        WHERE (b.email = :email);', array(
            ':email'    => $email
        ));

        if(count($results) === 0) {

            throw new \Exception('Error resetting password');
        }
        else {

            $data = $results[0];

            $results2 = $sql->select('CALL sp_users_passwords_recoveries_save(:user_id, :user_ip);', array(
                ':user_id'  => $data['user_id'],
                ':user_ip'  => $_SERVER['REMOTE_ADDR']
            ));

            if(count($results2) === 0) {

                throw new \Exception('Error resetting password');
            }
            else {

                $dataRecovery = $results2[0];

                $code = openssl_encrypt(
                    $dataRecovery['recovery_id'],
                    'AES-128-CBC',
                    pack('a16', User::SECRET),
                    0,
                    pack('a16', User::SECRET_IV)
                );

                $code = base64_encode($code);

                $link = 'http://www.hrsystem.com/forgot/reset?code='.$code;

                $mailer = new Mailer($data['email'], $data['fist_name'].$data['last_name'], array(
                    'name'  => $data['fist_name'].$data['last_name'],
                    'link'  => $link
                ));

                $mailer->send();
            }
        }
    }
}
?>