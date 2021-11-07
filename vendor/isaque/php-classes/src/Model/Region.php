<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class Region extends Model {

    const ERROR = 'RegionError';

    public function get($region_id) : void {
        try {

            $sql = new Sql();

            $values = $sql->select('SELECT * FROM regions WHERE(region_id = :region_id);', array(
                ':region_id'   => $region_id
            ));

            $this->setValues($values[0]);
        }
        catch(\Exception $e) {

            Region::setError('Error capturing the region!');
            header('Location: /regions');
            die;
        }
    }

    public static function listAll() : array {

        $sql = new Sql();

        return $sql->select('SELECT * FROM regions ORDER BY region_name');
    }

    public function insert() : void {
        try {

            if(empty($this->getregion_name())) {

                Region::setError('Please fill in all fields!');
                header('Location: /regions/create');
                exit;
            }
            else {
                $sql = new Sql();

                $results = $sql->select('CALL sp_regions_save(:pregion_id, :pregion_name);', array(
                    ':pregion_id'       => 0,
                    ':pregion_name'     => $this->getregion_name()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Region::setError('Error registering the region!');
            header('Location: /regions/create');
            die;
        } 
    }

    public function update() : void {
        try {

            if(
                empty($this->getregion_id()) ||
                empty($this->getregion_name())
            ) {

                Region::setError('Please fill in all fields!');
                header('Location: /regions/'.$this->getregion_id());
                exit;
            }
            else {
                $sql = new Sql();

                $results = $sql->select('CALL sp_regions_save(:pregion_id, :pregion_name);', array(
                    ':pregion_id'       => $this->getregion_id(),
                    ':pregion_name'     => $this->getregion_name()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Region::setError('Error updating the region!');
            header('Location: /regions/'.$this->getregion_id());
            die;
        } 
    }

    public function delete() : void {
        try {

            $sql = new Sql();

            $sql->query('DELETE FROM regions WHERE(region_id = :region_id);', array(
                ':region_id'    => $this->getregion_id()
            ));
        }
        catch(\Exception $e) {

            Region::setError('Error deleting the region!');
            header('Location: /regions');
            die;
        }
    }

    public static function search($region_id) : array {

        $sql = new Sql();

        return $sql->select('SELECT * FROM regions WHERE(region_id = :region_id);', array(
            ':region_id'   => $region_id
        ));
    }

    public static function setError($msg) : void {

        $_SESSION[Region::ERROR]   = $msg;
    }

    public static function getError() : string {

        $msg = (isset($_SESSION[Region::ERROR]) && ($_SESSION[Region::ERROR])) ? $_SESSION[Region::ERROR] : '';

        Region::clearError();

        return $msg;
    }

    public static function clearError() : void {

        $_SESSION[Region::ERROR]    = NULL;
    }
}
?>