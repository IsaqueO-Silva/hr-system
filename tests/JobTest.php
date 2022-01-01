<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model\Job;

class JobTest extends TestCase {

    public function testGetAJobFromDatabase() {

        $job = new Job();

        $job->get('1');

        $expected = array(
            'job_id'        => '1',
            'job_title'     => 'Programmer',
            'min_salary'    => '2000.00',
            'max_salary'    => '6000.00',
        );

        $this->assertEquals($expected, $job->getValues());
    }

    public function testListAllJobsFromDatabase() {

        $expected = array(
            array(
                'job_id'        => '1',
                'job_title'     => 'Programmer',
                'min_salary'    => '2000.00',
                'max_salary'    => '6000.00',
            )
        );

        $this->assertEquals($expected, Job::listAll());
    }

    public function testInsertAJobInDatabase() {

        $job = new Job();

        $job->setValues(array(
            'job_title'     => 'Software Enginner',
            'min_salary'    => '2000',
            'max_salary'    => '6000'
        ));

        $job->insert();

        $expected = array(
            'job_id'        => $job->getjob_id(),
            'job_title'     => $job->getjob_title(),
            'min_salary'    => $job->getmin_salary(),
            'max_salary'    => $job->getmax_salary()
        );

        $this->assertEquals($expected, $job->getValues());
    }

    public function testUpdateAJobInDatabase() {

        $job = new Job();

        $job->setValues(array(
            'job_id'        => '30',
            'job_title'     => 'Data Scientist',
            'min_salary'    => '2000',
            'max_salary'    => '6000'
        ));

        $job->update();

        $expected = array(
            'job_id'        => $job->getjob_id(),
            'job_title'     => $job->getjob_title(),
            'min_salary'    => $job->getmin_salary(),
            'max_salary'    => $job->getmax_salary()
        );

        $this->assertEquals($expected, $job->getValues());
    }

    public function testDeleteAJobInDatabase() {

        $job = new Job();

        $job->setValues(array(
            'job_id'    => '30'
        ));

        $expected = '';

        $this->assertEquals($expected, $job->delete());
    }

    public function testSearchAJobInDatabase() {

        $expected = array(
            array(
                'job_id'        => '1',
                'job_title'     => 'Programmer',
                'min_salary'    => '2000.00',
                'max_salary'    => '6000.00'
            )
        );

        $this->assertEquals($expected, Job::search(1));
    }

    public function testSetAndGetAnErrorMessageForTheJobClass() {

        $expected = 'Error message';

        Job::setError('Error message');

        $this->assertEquals($expected, Job::getError());
    }

    public function testClearAnErrorMessageFromTheJobClass() {

        $expected = NULL;

        Job::setError('Error message');

        Job::clearError();

        $this->assertEquals($expected, Job::getError());
    }
}
?>