<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class Job extends Model {

    const ERROR     = 'JobError';

    public function get($job_id) : void {
        try {

            $sql = new Sql();

            $values = $sql->select('SELECT * FROM jobs WHERE(job_id = :job_id);', array(
                ':job_id'   => $job_id
            ));

            $this->setValues($values[0]);
        }
        catch(\Exception $e) {

            Job::setError('Error capturing the job!');
            header('Location: /jobs');
            die;
        }
    }

    public static function listAll() : array {

        $sql = new Sql();

        return $sql->select('SELECT * FROM jobs ORDER BY job_title');
    }

    public function insert() : void {
        try {

            if(
                empty($this->getjob_title()) ||
                empty($this->getmin_salary()) ||
                empty($this->getmax_salary())
            ) {
                Job::setError('Please fill in all fields!');
                header('Location: /jobs/create');
                exit;
            }
            else {

                if($this->getmin_salary() > $this->getmax_salary()) {

                    Job::setError('The minimum salary cannot be greater than the maximum salary!');
                    header('Location: /jobs/create');
                    exit;
                }

                $job_id = ($this->getjob_id()) ? $this->getjob_id() : 0;

                $sql = new Sql();

                $results = $sql->select('CALL sp_jobs_save(:pjob_id, :pjob_title, :pmin_salary, :pmax_salary);', array(
                    ':pjob_id'      => $job_id,
                    ':pjob_title'   => $this->getjob_title(),
                    ':pmin_salary'  => $this->getmin_salary(),
                    ':pmax_salary'  => $this->getmax_salary()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Job::setError('Error registering the job!');
            header('Location: /jobs/create');
            die;
        } 
    }

    public function update() : void {
        try {

            if(
                empty($this->getjob_id()) ||
                empty($this->getjob_title()) ||
                empty($this->getmin_salary()) ||
                empty($this->getmax_salary())
            ) {
                Job::setError('Please fill in all fields!');
                header('Location: /jobs/'.$this->getjob_id());
                exit;
            }
            else {

                if($this->getmin_salary() > $this->getmax_salary()) {

                    Job::setError('The minimum salary cannot be greater than the maximum salary!');
                    header('Location: /jobs/'.$this->getjob_id());
                    exit;
                }

                $sql = new Sql();

                $results = $sql->select('CALL sp_jobs_save(:pjob_id, :pjob_title, :pmin_salary, :pmax_salary);', array(
                    ':pjob_id'      => $this->getjob_id(),
                    ':pjob_title'   => $this->getjob_title(),
                    ':pmin_salary'  => $this->getmin_salary(),
                    ':pmax_salary'  => $this->getmax_salary()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Job::setError('Error updating the job!');
            header('Location: /jobs/'.$this->getjob_id());
            die;
        } 
    }

    public function delete() : void {
        try {

            $sql = new Sql();

            $sql->query('DELETE FROM jobs WHERE(job_id = :job_id);', array(
                ':job_id'    => $this->getjob_id()
            ));
        }
        catch(\Exception $e) {

            Job::setError('Error deleting the job!');
            header('Location: /jobs');
            die;
        }
    }

    public static function setError($msg) : void {

        $_SESSION[Job::ERROR]   = $msg;
    }

    public static function getError() : string {

        $msg = (isset($_SESSION[Job::ERROR]) && ($_SESSION[Job::ERROR])) ? $_SESSION[Job::ERROR] : '';

        Job::clearError();

        return $msg;
    }

    public static function clearError() : void {

        $_SESSION[Job::ERROR]    = NULL;
    }
}
?>