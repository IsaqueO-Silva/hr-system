<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class Employee extends Model {

    const ERROR = 'EmployeeError';

    public function get($employee_id) : void {
        try {

            $sql = new Sql();

            $values = $sql->select('SELECT * FROM employees a INNER JOIN regions b ON (a.region_id = b.region_id) WHERE(employee_id = :employee_id);', array(
                ':employee_id'   => $employee_id
            ));

            $this->setValues($values[0]);
        }
        catch(\Exception $e) {

            Employee::setError('Error capturing the employee!');
            header('Location: /employees');
            die;
        }
    }

    public static function listAll() : array {

        $sql = new Sql();

        return $sql->select('SELECT *
        FROM employees a
        INNER JOIN jobs b ON (a.job_id = b.job_id)
        INNER JOIN departments c ON (a.department_id = c.department_id)
        ORDER BY a.fist_name;');
    }

    public function insert() : void {
        try {

            if(
                empty($this->getfist_name()) ||
                empty($this->getlast_name()) ||
                empty($this->getemail()) ||
                empty($this->getphone_number()) ||
                empty($this->gethire_date()) ||
                empty($this->getjob_id()) ||
                empty($this->getsalary()) ||
                empty($this->getdepartment_id())
            ) {

                Employee::setError('Please fill in all fields!');
                header('Location: /employees/create');
                exit;
            }
            else {
                $sql = new Sql();

                $results = $sql->select('CALL sp_employees_save(:pemployee_id, :pemployee_name, :pregion_id);', array(
                    ':pemployee_id'          => 0,
                    ':pemployee_name'        => $this->getemployee_name(),
                    ':pregion_id'           => $this->getregion_id()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Employee::setError('Error registering the employee!');
            header('Location: /employees/create');
            die;
        } 
    }

    public function update() : void {
        try {

            if(
                empty($this->getemployee_id()) ||
                empty($this->getemployee_name()) ||
                empty($this->getregion_id())
            ) {

                Employee::setError('Please fill in all fields!');
                header('Location: /employees/'.$this->getemployee_id());
                exit;
            }
            else {

                $sql = new Sql();

                $results = $sql->select('CALL sp_employees_save(:pemployee_id, :pemployee_name, :pregion_id);', array(
                    ':pemployee_id'      => $this->getemployee_id(),
                    ':pemployee_name'    => $this->getemployee_name(),
                    ':pregion_id'       => $this->getregion_id()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Employee::setError('Error updating the employee!');
            header('Location: /employees/'.$this->getemployee_id());
            die;
        } 
    }

    public function delete() : void {
        try {

            $sql = new Sql();

            $sql->query('DELETE FROM employees WHERE(employee_id = :employee_id);', array(
                ':employee_id'    => $this->getemployee_id()
            ));
        }
        catch(\Exception $e) {

            Employee::setError('Error deleting the employee!');
            header('Location: /employees');
            die;
        }
    }

    public static function search($employee_id) : array {

        if(!(is_numeric($employee_id))) {

            return array();
        }

        $sql = new Sql();

        return $sql->select('SELECT * FROM employees WHERE(employee_id = :employee_id);', array(
            ':employee_id'   => $employee_id
        ));
    }

    public static function setError($msg) : void {

        $_SESSION[Employee::ERROR]   = $msg;
    }

    public static function getError() : string {

        $msg = (isset($_SESSION[Employee::ERROR]) && ($_SESSION[Employee::ERROR])) ? $_SESSION[Employee::ERROR] : '';

        Employee::clearError();

        return $msg;
    }

    public static function clearError() : void {

        $_SESSION[Employee::ERROR]    = NULL;
    }
}
?>