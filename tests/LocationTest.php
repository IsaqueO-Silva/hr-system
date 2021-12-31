<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model\Location;

class LocationTest extends TestCase {

    public function testGetALocationFromDatabase() {

        $location = new Location();

        $location->get('2');

        $expected = array(
            'location_id'       =>'2',
            'street_address'    =>'Street Brazil',
            'postal_code'       =>'16300000',
            'city'              =>'Standard City',
            'state_province'    =>'SP',
            'country_id'        =>'1',
            'country_name'      =>'Brazil',
            'region_id'         =>'1'
        );

        $this->assertEquals($expected, $location->getValues());
    }

    public function testListAllLocationsFromDatabase() {

        $expected = array(
            array(
                'location_id'       =>'2',
                'street_address'    =>'Street Brazil',
                'postal_code'       =>'16300000',
                'city'              =>'Standard City',
                'state_province'    =>'SP',
                'country_id'        =>'1',
                'country_name'      =>'Brazil',
                'region_id'         =>'1'
            )
        );

        $this->assertEquals($expected, Location::listAll());
    }

    public function testInsertALocationInDatabase() {

        $location = new Location();

        $location->setValues(array(
            'street_address'    =>'Street test',
            'postal_code'       =>'00000000',
            'city'              =>'City test',
            'state_province'    =>'State test',
            'country_id'        =>'1'
        ));

        $location->insert();

        $expected = array(
            'location_id'       => $location->getlocation_id(),
            'street_address'    => $location->getstreet_address(),
            'postal_code'       => $location->getpostal_code(),
            'city'              => $location->getcity(),
            'state_province'    => $location->getstate_province(),
            'country_id'        => $location->getcountry_id()
        );

        $this->assertEquals($expected, $location->getValues());
    }

    public function testUpdateALocationInDatabase() {

        $location = new Location();

        $location->setValues(array(
            'location_id'       => '7',
            'street_address'    =>'Street test 1',
            'postal_code'       =>'00000001',
            'city'              =>'City test 1',
            'state_province'    =>'State test 1',
            'country_id'        =>'1'
        ));

        $location->update();

        $expected = array(
            'location_id'       => $location->getlocation_id(),
            'street_address'    => $location->getstreet_address(),
            'postal_code'       => $location->getpostal_code(),
            'city'              => $location->getcity(),
            'state_province'    => $location->getstate_province(),
            'country_id'        => $location->getcountry_id()
        );

        $this->assertEquals($expected, $location->getValues());
    }

    public function testDeleteALocationInDatabase() {

        $location = new Location();

        $location->setValues(array(
            'location_id'    => '7'
        ));

        $expected = '';

        $this->assertEquals($expected, $location->delete());
    }

    public function testSearchALocationInDatabase() {

        $expected = array(
            array(
                'location_id'       =>'2',
                'street_address'    =>'Street Brazil',
                'postal_code'       =>'16300000',
                'city'              =>'Standard City',
                'state_province'    =>'SP',
                'country_id'        =>'1'
            )
        );

        $this->assertEquals($expected, Location::search(2));
    }

    public function testSetAndGetAnErrorMessageForTheLocationClass() {

        $expected = 'Error message';

        Location::setError('Error message');

        $this->assertEquals($expected, Location::getError());
    }

    public function testClearAnErrorMessageFromTheLocationClass() {

        $expected = NULL;

        Location::setError('Error message');

        Location::clearError();

        $this->assertEquals($expected, Location::getError());
    }
}
?>