<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model\Region;

class RegionTest extends TestCase {

    public function testGetARegionFromDatabase() {

        $region = new Region();

        $region->get('1');

        $expected = array(
            'region_id'     => '1',
            'region_name'   => 'South America'
        );

        $this->assertEquals($expected, $region->getValues());
    }

    public function testListAllRegionsFromDatabase() {

        $expected = array(
            array(
                'region_id'     => '1',
                'region_name'   => 'South America'
            )
        );

        $this->assertEquals($expected, Region::listAll());
    }

    public function testInsertARegionInDatabase() {

        $region = new Region();

        $region->setValues(array(
            'region_name'  => 'Oceania'
        ));

        $region->insert();

        $expected = array(
            'region_id'    => $region->getregion_id(),
            'region_name'  => $region->getregion_name()
        );

        $this->assertEquals($expected, $region->getValues());
    }

    public function testUpdateARegionInDatabase() {

        $region = new Region();

        $region->setValues(array(
            'region_id'    => '18',
            'region_name'  => 'Europe'
        ));

        $region->update();

        $expected = array(
            'region_id'    => $region->getregion_id(),
            'region_name'  => $region->getregion_name()
        );

        $this->assertEquals($expected, $region->getValues());
    }

    public function testDeleteARegionInDatabase() {

        $region = new Region();

        $region->setValues(array(
            'region_id'    => '18'
        ));

        $expected = '';

        $this->assertEquals($expected, $region->delete());
    }

    public function testSearchARegionInDatabase() {

        $expected = array(
            array(
                'region_id'      =>    '1',
                'region_name'    =>    'South America'
            )
        );

        $this->assertEquals($expected, Region::search(1));
    }

    public function testSetAndGetAnErrorMessageForTheRegionClass() {

        $expected = 'Error message';

        Region::setError('Error message');

        $this->assertEquals($expected, Region::getError());
    }

    public function testClearAnErrorMessageFromTheRegionClass() {

        $expected = NULL;

        Region::setError('Error message');

        Region::clearError();

        $this->assertEquals($expected, Region::getError());
    }
}
?>