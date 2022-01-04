<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model;

class ModelTest extends TestCase {

    public function testTestSetterAndGetterDefaultUsages() {

        $model = new Model();

        $model->setValues(array(
            'value1'  => '1',
            'value2'  => '2',
        ));

        $expected = array(
            'value1'  =>  '1',
            'value2'  =>  '2'
        );

        $this->assertEquals($expected, $model->getValues());
    }
}
?>