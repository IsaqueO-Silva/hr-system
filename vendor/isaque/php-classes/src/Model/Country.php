<?php

namespace Isaque\Model;

use Isaque\Model;
use Isaque\DB\Sql;

class Country extends Model {

    const ERROR = 'CountryError';

    public function get($country_id) : void {
        try {

            $sql = new Sql();

            $values = $sql->select('SELECT * FROM countries a INNER JOIN regions b ON (a.region_id = b.region_id) WHERE(country_id = :country_id);', array(
                ':country_id'   => $country_id
            ));

            $this->setValues($values[0]);
        }
        catch(\Exception $e) {

            Country::setError('Error capturing the country!');
            header('Location: /countries');
            die;
        }
    }

    public static function listAll() : array {

        $sql = new Sql();

        return $sql->select('SELECT * FROM countries a INNER JOIN regions b ON (a.region_id = b.region_id) ORDER BY country_name;');
    }

    public function insert() : void {
        try {

            if(
                empty($this->getcountry_name()) ||
                empty($this->getregion_id())
            ) {

                Country::setError('Please fill in all fields!');
                header('Location: /countries/create');
                exit;
            }
            else {
                $sql = new Sql();

                $results = $sql->select('CALL sp_countries_save(:pcountry_id, :pcountry_name, :pregion_id);', array(
                    ':pcountry_id'          => 0,
                    ':pcountry_name'        => $this->getcountry_name(),
                    ':pregion_id'           => $this->getregion_id()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Country::setError('Error registering the country!');
            header('Location: /countries/create');
            die;
        } 
    }

    public function update() : void {
        try {

            if(
                empty($this->getcountry_id()) ||
                empty($this->getcountry_name()) ||
                empty($this->getregion_id())
            ) {

                Country::setError('Please fill in all fields!');
                header('Location: /countries/'.$this->getcountry_id());
                exit;
            }
            else {

                $sql = new Sql();

                $results = $sql->select('CALL sp_countries_save(:pcountry_id, :pcountry_name, :pregion_id);', array(
                    ':pcountry_id'      => $this->getcountry_id(),
                    ':pcountry_name'    => $this->getcountry_name(),
                    ':pregion_id'       => $this->getregion_id()
                ));

                $this->setValues($results[0]);
            }
        }
        catch(\Exception $e) {

            Country::setError('Error updating the country!');
            header('Location: /countries/'.$this->getcountry_id());
            die;
        } 
    }

    public function delete() : void {
        try {

            $sql = new Sql();

            $sql->query('DELETE FROM countries WHERE(country_id = :country_id);', array(
                ':country_id'    => $this->getcountry_id()
            ));
        }
        catch(\Exception $e) {

            Country::setError('Error deleting the country!');
            header('Location: /countries');
            die;
        }
    }

    public static function search($country_id) : array {

        if(!(is_numeric($country_id))) {

            return array();
        }

        $sql = new Sql();

        return $sql->select('SELECT * FROM countries WHERE(country_id = :country_id);', array(
            ':country_id'   => $country_id
        ));
    }

    public static function setError($msg) : void {

        $_SESSION[Country::ERROR]   = $msg;
    }

    public static function getError() : string {

        $msg = (isset($_SESSION[Country::ERROR]) && ($_SESSION[Country::ERROR])) ? $_SESSION[Country::ERROR] : '';

        Country::clearError();

        return $msg;
    }

    public static function clearError() : void {

        $_SESSION[Country::ERROR]    = NULL;
    }
}
?>