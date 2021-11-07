<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class Location extends Model {

    const ERROR = 'LocationError';

    public function get($location_id) : void {
        try {

            $sql = new Sql();

            $values = $sql->select('SELECT * FROM locations WHERE(location_id = :location_id);', array(
                ':location_id'   => $location_id
            ));

            $this->setValues($values[0]);
        }
        catch(\Exception $e) {

            Location::setError('Error capturing the location!');
            header('Location: /locations');
            die;
        }
    }

    public static function listAll() : array {

        $sql = new Sql();

        return $sql->select('SELECT * FROM locations ORDER BY location_name');
    }

    public function insert() : void {
        try {

            if(empty($this->getlocation_name())) {

                Location::setError('Please fill in all fields!');
                header('Location: /locations/create');
                exit;
            }
            else {
                $location_id = ($this->getlocation_id()) ? $this->getlocation_id() : 0;

                $sql = new Sql();

                $results = $sql->select('CALL sp_locations_save(:plocation_id, :plocation_name);', array(
                    ':plocation_id'       => $location_id,
                    ':plocation_name'     => $this->getlocation_name()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Location::setError('Error registering the location!');
            header('Location: /locations/create');
            die;
        } 
    }

    public function update() : void {
        try {

            if(
                empty($this->getlocation_id()) ||
                empty($this->getlocation_name())
            ) {

                Location::setError('Please fill in all fields!');
                header('Location: /locations/'.$this->getlocation_id());
                exit;
            }
            else {
                $sql = new Sql();

                $results = $sql->select('CALL sp_locations_save(:plocation_id, :plocation_name);', array(
                    ':plocation_id'       => $this->getlocation_id(),
                    ':plocation_name'     => $this->getlocation_name()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Location::setError('Error updating the location!');
            header('Location: /locations/'.$this->getlocation_id());
            die;
        } 
    }

    public function delete() : void {
        try {

            $sql = new Sql();

            $sql->query('DELETE FROM locations WHERE(location_id = :location_id);', array(
                ':location_id'    => $this->getlocation_id()
            ));
        }
        catch(\Exception $e) {

            Location::setError('Error deleting the location!');
            header('Location: /locations');
            die;
        }
    }

    public static function search($location_id) : array {

        $sql = new Sql();

        return $sql->select('SELECT * FROM locations WHERE(location_id = :location_id);', array(
            ':location_id'   => $location_id
        ));
    }

    public static function setError($msg) : void {

        $_SESSION[Location::ERROR]   = $msg;
    }

    public static function getError() : string {

        $msg = (isset($_SESSION[Location::ERROR]) && ($_SESSION[Location::ERROR])) ? $_SESSION[Location::ERROR] : '';

        Location::clearError();

        return $msg;
    }

    public static function clearError() : void {

        $_SESSION[Location::ERROR]    = NULL;
    }
}
?>