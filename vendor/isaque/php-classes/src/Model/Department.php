<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class Department extends Model {

    const ERROR = 'DepartmentError';

    public function get($department_id) : void {
        try {

            $sql = new Sql();

            $values = $sql->select('SELECT * FROM departments a INNER JOIN locations b ON (a.location_id = b.location_id) WHERE(department_id = :department_id);', array(
                ':department_id'   => $department_id
            ));

            $this->setValues($values[0]);
        }
        catch(\Exception $e) {

            Department::setError('Error capturing the department!');
            header('Location: /departments');
            die;
        }
    }

    public static function listAll() : array {

        $sql = new Sql();

        return $sql->select('SELECT * FROM departments a INNER JOIN locations b ON (a.location_id = b.location_id) ORDER BY department_name;');
    }

    public function insert() : void {
        try {

            if(
                empty($this->getdepartment_name()) ||
                empty($this->getlocation_id())
            ) {

                Department::setError('Please fill in all fields!');
                header('Location: /departments/create');
                exit;
            }
            else {
                $sql = new Sql();

                $results = $sql->select('CALL sp_departments_save(:pdepartment_id, :pdepartment_name, :plocation_id);', array(
                    ':pdepartment_id'       => 0,
                    ':pdepartment_name'     => $this->getdepartment_name(),
                    ':plocation_id'         => $this->getlocation_id()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Department::setError('Error registering the department!');
            header('Location: /departments/create');
            die;
        } 
    }

    public function update() : void {
        try {

            if(
                empty($this->getdepartment_id()) ||
                empty($this->getdepartment_name()) ||
                empty($this->getlocation_id())
            ) {

                Department::setError('Please fill in all fields!');
                header('Location: /departments/'.$this->getdepartment_id());
                exit;
            }
            else {

                $sql = new Sql();

                $results = $sql->select('CALL sp_departments_save(:pdepartment_id, :pdepartment_name, :plocation_id);', array(
                    ':pdepartment_id'      => $this->getdepartment_id(),
                    ':pdepartment_name'    => $this->getdepartment_name(),
                    ':plocation_id'       => $this->getlocation_id()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Department::setError('Error updating the department!');
            header('Location: /departments/'.$this->getdepartment_id());
            die;
        } 
    }

    public function delete() : void {
        try {

            $sql = new Sql();

            $sql->query('DELETE FROM departments WHERE(department_id = :department_id);', array(
                ':department_id'    => $this->getdepartment_id()
            ));
        }
        catch(\Exception $e) {

            Department::setError('Error deleting the department!');
            header('Location: /departments');
            die;
        }
    }

    public static function search($department_id) : array {

        if(!(is_numeric($department_id))) {

            return array();
        }

        $sql = new Sql();

        return $sql->select('SELECT * FROM departments WHERE(department_id = :department_id);', array(
            ':department_id'   => $department_id
        ));
    }

    public static function setError($msg) : void {

        $_SESSION[Department::ERROR]   = $msg;
    }

    public static function getError() : string {

        $msg = (isset($_SESSION[Department::ERROR]) && ($_SESSION[Department::ERROR])) ? $_SESSION[Department::ERROR] : '';

        Department::clearError();

        return $msg;
    }

    public static function clearError() : void {

        $_SESSION[Department::ERROR]    = NULL;
    }
}
?>