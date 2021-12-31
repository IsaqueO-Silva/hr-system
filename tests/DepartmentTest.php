<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model\Department;

class DepartmentTest extends TestCase {

    public function testGetADepartmentFromDatabase() {

        $department = new Department();

        $department->get('1');

        $expected = array(
            'department_id'     => '1',
            'department_name'   => 'IT',
            'location_id'       => '2',
            'street_address'    => 'Street Brazil',
            'postal_code'       => '16300000',
            'city'              => 'Standard City',
            'state_province'    => 'SP',
            'country_id'        => '1'
        );

        $this->assertEquals($expected, $department->getValues());
    }

    public function testListAllDepartmentsFromDatabase() {

        $expected = array(
            array(
                'department_id'     => '1',
                'department_name'   => 'IT',
                'location_id'       => '2',
                'street_address'    => 'Street Brazil',
                'postal_code'       => '16300000',
                'city'              => 'Standard City',
                'state_province'    => 'SP',
                'country_id'        => '1'
            )
        );

        $this->assertEquals($expected, Department::listAll());
    }

    public function testInsertADepartmentInDatabase() {

        $department = new Department();

        $department->setValues(array(
            'department_name'   => 'HR',
            'location_id'       => '2'
        ));

        $department->insert();

        $expected = array(
            'department_id'     => $department->getdepartment_id(),
            'department_name'   => $department->getdepartment_name(),
            'location_id'       => $department->getlocation_id()
        );

        $this->assertEquals($expected, $department->getValues());
    }

    public function testUpdateADepartmentInDatabase() {

        $department = new Department();

        $department->setValues(array(
            'department_id'     => '11',
            'department_name'   => 'Production',
            'location_id'       => '2'
        ));

        $department->update();

        $expected = array(
            'department_id'     => $department->getdepartment_id(),
            'department_name'   => $department->getdepartment_name(),
            'location_id'       => $department->getlocation_id()
        );

        $this->assertEquals($expected, $department->getValues());
    }

    public function testDeleteADepartmentInDatabase() {

        $department = new Department();

        $department->setValues(array(
            'department_id'    => '11'
        ));

        $expected = '';

        $this->assertEquals($expected, $department->delete());
    }

    public function testSearchADepartmentInDatabase() {

        $expected = array(
            array(
                'department_id'     =>'1',
                'department_name'   =>'IT',
                'location_id'       =>'2'
            )
        );

        $this->assertEquals($expected, Department::search(1));
    }

    public function testSetAndGetAnErrorMessageForTheDepartmentClass() {

        $expected = 'Error message';

        Department::setError('Error message');

        $this->assertEquals($expected, Department::getError());
    }

    public function testClearAnErrorMessageFromTheDepartmentClass() {

        $expected = NULL;

        Department::setError('Error message');

        Department::clearError();

        $this->assertEquals($expected, Department::getError());
    }
}
?>