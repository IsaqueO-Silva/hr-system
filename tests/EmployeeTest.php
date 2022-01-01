<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model\Employee;

class EmployeeTest extends TestCase {

    public function testGetAEmployeeFromDatabase() {

        $employee = new Employee();

        $employee->get('8');

        $expected = array(
            'employee_id'       => '8',
            'fist_name'         => 'John',
            'last_name'         => 'Doe',
            'email'             => 'johndoe@outlook.com',
            'phone_number'      => '202 555 0136',
            'hire_date'         => '2021-11-28',
            'job_id'            => '1',
            'job_title'         => 'Programmer',
            'salary'            => '6000.00',
            'department_id'     => '1',
            'department_name'   => 'IT',
            'login'             => 'joao'
        );

        $this->assertEquals($expected, $employee->getValues());
    }

    public function testListAllEmployeesFromDatabase() {

        $expected = array(
            array(
                'employee_id'       => '8',
                'fist_name'         => 'John',
                'last_name'         => 'Doe',
                'email'             => 'johndoe@outlook.com',
                'phone_number'      => '202 555 0136',
                'hire_date'         => '2021-11-28 00:00:00',
                'job_id'            => '1',
                'salary'            => '6000.00',
                'department_id'     => '1',
                'job_title'         => 'Programmer',
                'min_salary'        => '2000.00',
                'max_salary'        => '6000.00',
                'department_name'   => 'IT',
                'location_id'       => '2'
            )
        );

        $this->assertEquals($expected, Employee::listAll());
    }

    public function testInsertAEmployeeInDatabase() {

        $employee = new Employee();

        $employee->setValues(array(
            'fist_name'         => 'John',
            'last_name'         => 'Doe2',
            'email'             => 'johndoe2@outlook.com',
            'phone_number'      => '202 444 0212',
            'hire_date'         => '2021-12-01 00:00:00',
            'job_id'            => '1',
            'salary'            => '6000.00',
            'department_id'     => '1',
        ));

        $employee->insert();

        $expected = array(
            'employee_id'   => $employee->getemployee_id(),
            'fist_name'     => $employee->getfist_name(),
            'last_name'     => $employee->getlast_name(),
            'email'         => $employee->getemail(),
            'phone_number'  => $employee->getphone_number(),
            'hire_date'     => $employee->gethire_date(),
            'job_id'        => $employee->getjob_id(),
            'salary'        => $employee->getsalary(),
            'department_id' => $employee->getdepartment_id()
        );

        $this->assertEquals($expected, $employee->getValues());
    }

    public function testUpdateAEmployeeInDatabase() {

        $employee = new Employee();

        $employee->setValues(array(
            'employee_id'       => '10',
            'fist_name'         => 'John',
            'last_name'         => 'Doe3',
            'email'             => 'johndoe2@outlook.com',
            'phone_number'      => '202 444 0212',
            'hire_date'         => '2021-12-01',
            'job_id'            => '1',
            'salary'            => '6000.00',
            'department_id'     => '1',
            'login'            => 'johndoe'
        ));

        $employee->update();

        $expected = array(
            'employee_id'   => $employee->getemployee_id(),
            'fist_name'     => $employee->getfist_name(),
            'last_name'     => $employee->getlast_name(),
            'email'         => $employee->getemail(),
            'phone_number'  => $employee->getphone_number(),
            'hire_date'     => $employee->gethire_date(),
            'job_id'        => $employee->getjob_id(),
            'salary'        => $employee->getsalary(),
            'department_id' => $employee->getdepartment_id(),
            'login'         => $employee->getlogin()
        );

        $this->assertEquals($expected, $employee->getValues());
    }

    public function testDeleteAEmployeeInDatabase() {

        $employee = new Employee();

        $employee->setValues(array(
            'employee_id'    => '10'
        ));

        $expected = '';

        $this->assertEquals($expected, $employee->delete());
    }

    public function testSearchAEmployeeInDatabase() {

        $expected = array(
            array(
                'employee_id'   => '8',
                'fist_name'     => 'John',
                'last_name'     => 'Doe',
                'email'         => 'johndoe@outlook.com',
                'phone_number'  => '202 555 0136',
                'hire_date'     => '2021-11-28 00:00:00',
                'job_id'        => '1',
                'salary'        => '6000.00',
                'department_id' => '1'
            )
        );

        $this->assertEquals($expected, Employee::search(8));
    }

    public function testSetAndGetAnErrorMessageForTheEmployeeClass() {

        $expected = 'Error message';

        Employee::setError('Error message');

        $this->assertEquals($expected, Employee::getError());
    }

    public function testClearAnErrorMessageFromTheEmployeeClass() {

        $expected = NULL;

        Employee::setError('Error message');

        Employee::clearError();

        $this->assertEquals($expected, Employee::getError());
    }
}
?>