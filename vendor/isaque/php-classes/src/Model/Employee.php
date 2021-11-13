<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class Employee extends Model {

    const ERROR = 'EmployeeError';

    public function get($employee_id) : void {
        try {

            $sql = new Sql();

            $values = $sql->select('SELECT
            a.employee_id,
            a.fist_name,
            a.last_name,
            a.email,
            a.phone_number,
            a.hire_date,
            a.job_id,
            b.job_title,
            a.salary,
            a.department_id,
            c.department_name,
            d.login
            FROM employees a
            INNER JOIN jobs b ON (a.job_id = b.job_id)
            INNER JOIN departments c ON (a.department_id = c.department_id)
            LEFT JOIN users d ON (a.employee_id = d.employee_id)
            WHERE(a.employee_id = :employee_id);',
            array(
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

                $results = $sql->select('CALL sp_employees_save(:pemployee_id, :pfist_name, :plast_name, :pemail, :pphone_number, :phire_date, :pjob_id, :psalary, :pdepartment_id, :plogin, :ppassword);', array(
                    ':pemployee_id'     => 0,
                    ':pfist_name'       => $this->getfist_name(),
                    ':plast_name'       => $this->getlast_name(),
                    ':pemail'           => $this->getemail(),
                    ':pphone_number'    => $this->getphone_number(),
                    ':phire_date'       => $this->gethire_date(),
                    ':pjob_id'          => $this->getjob_id(),
                    ':psalary'          => $this->getsalary(),
                    ':pdepartment_id'   => $this->getdepartment_id(),
                    ':plogin'           => $this->getlogin(),
                    ':ppassword'        => $this->getpassword()
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
                empty($this->getfist_name()) ||
                empty($this->getlast_name()) ||
                empty($this->getemail()) ||
                empty($this->getphone_number()) ||
                empty($this->gethire_date()) ||
                empty($this->getjob_id()) ||
                empty($this->getsalary()) ||
                empty($this->getdepartment_id()) ||
                empty($this->getlogin())
            ) {

                Employee::setError('Please fill in all fields!');
                header('Location: /employees/'.$this->getemployee_id());
                exit;
            }
            else {

                $sql = new Sql();

                $results = $sql->select('CALL sp_employees_save(:pemployee_id, :pfist_name, :plast_name, :pemail, :pphone_number, :phire_date, :pjob_id, :psalary, :pdepartment_id, :plogin, :ppassword);', array(
                    ':pemployee_id'     => $this->getemployee_id(),
                    ':pfist_name'       => $this->getfist_name(),
                    ':plast_name'       => $this->getlast_name(),
                    ':pemail'           => $this->getemail(),
                    ':pphone_number'    => $this->getphone_number(),
                    ':phire_date'       => $this->gethire_date(),
                    ':pjob_id'          => $this->getjob_id(),
                    ':psalary'          => $this->getsalary(),
                    ':pdepartment_id'   => $this->getdepartment_id(),
                    ':plogin'           => $this->getlogin()
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