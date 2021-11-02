<?php

namespace Isaque\DB;

Class Sql {

    const HOSTNAME = '127.0.0.1';
    const DATABASE = 'db_hr';
    const USERNAME = 'root';
    const PASSWORD = '';

    private $conn;

    public function __construct() {

        $this->conn = new \PDO('mysql:host='.Sql::HOSTNAME.';dbname='.Sql::DATABASE,Sql::USERNAME,Sql::PASSWORD);
    }

    public function setParams($stmt, $params = array()) : void {

        foreach($params as $key => $value) {

            $this->setParam($stmt, $key, $value);
        }
    }

    public function setParam($stmt, $key, $value) : void {

        $stmt->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()) : void {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();
    }

    public function select($rawQuery, $params = array()) : array {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>