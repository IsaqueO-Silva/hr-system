<?php

namespace Isaque;

class Model {

    private $values = array();

    /* Dynamic getters/setters */
    public function __call($method, $value) {

        $methodDiff = substr($method, 0, 3);

        $methodName = substr($method, 3, strlen($method));

        switch($methodDiff) {

            case 'get':

                return (isset($this->values[$methodName])) ? $this->values[$methodName] : NULL;
            break;

            case 'set':

                $this->values[$methodName] = $value[0];
            break;
        }
    }

    public function getValues() {

        return $this->values;
    }

    public function setValues($data = array()) {

        foreach($data as $key => $value) {

            $this->{'set'.$key}($value);
        }
    }
}
?>