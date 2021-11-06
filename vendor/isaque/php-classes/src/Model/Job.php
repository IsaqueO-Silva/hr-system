<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class Job extends Model{

    public function get($job_id) {

        $sql = new Sql();

        $values = $sql->select('SELECT * FROM jobs WHERE(job_id = :job_id);', array(
            ':job_id'   => $job_id
        ));

        $this->setValues($values[0]);
    }

    public static function listAll() {

        $sql = new Sql();

        return $sql->select('SELECT * FROM jobs ORDER BY job_title');
    }

    public function save() {

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

    public function delete() {

        $sql = new Sql();

        $sql->query('DELETE FROM jobs WHERE(job_id = :job_id);', array(
            ':job_id'    => $this->getjob_id()
        ));
    }
}
?>