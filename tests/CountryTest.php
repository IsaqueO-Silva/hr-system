<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model\Country;

class CountryTest extends TestCase {

    public function testGetACountryFromDatabase() {

        $country = new Country();

        $country->get('1');

        $expected = array(
            'country_id'    => '1',
            'country_name'  => 'Brazil',
            'region_id'     => '1',
            'region_name'   => 'South America'
        );

        $this->assertEquals($expected, $country->getValues());
    }

    public function testListAllCountriesFromDatabase() {

        $expected = array(
            array(
                'country_id'    => '1',
                'country_name'  => 'Brazil',
                'region_id'     => '1',
                'region_name'   => 'South America'
            )
        );

        $this->assertEquals($expected, Country::listAll());
    }

    public function testInsertACountryInDatabase() {

        $country = new Country();

        $country->setValues(array(
            'country_name'  => 'Chile',
            'region_id'     => '1'
        ));

        $country->insert();

        $expected = array(
            'country_id'    => $country->getcountry_id(),
            'country_name'  => $country->getcountry_name(),
            'region_id'     => $country->getregion_id()
        );

        $this->assertEquals($expected, $country->getValues());
    }

    public function testUpdateACountryInDatabase() {

        $country = new Country();

        $country->setValues(array(
            'country_id'    => '32',
            'country_name'  => 'Guyana',
            'region_id'     => '1'
        ));

        $country->update();

        $expected = array(
            'country_id'    => $country->getcountry_id(),
            'country_name'  => $country->getcountry_name(),
            'region_id'     => $country->getregion_id()
        );

        $this->assertEquals($expected, $country->getValues());
    }

    public function testDeleteACountryInDatabase() {

        $country = new Country();

        $country->setValues(array(
            'country_id'    => '32'
        ));

        $expected = '';

        $this->assertEquals($expected, $country->delete());
    }

    public function testSearchACountryInDatabase() {

        $expected = array(
            array(
                'country_id'      =>    '1',
                'country_name'    =>    'Brazil',
                'region_id'       =>    '1'
            )
        );

        $this->assertEquals($expected, Country::search(1));
    }

    public function testSetAndGetAnErrorMessageForTheCountryClass() {

        $expected = 'Error message';

        Country::setError('Error message');

        $this->assertEquals($expected, Country::getError());
    }

    public function testClearAnErrorMessageFromTheCountryClass() {

        $expected = NULL;

        Country::setError('Error message');

        Country::clearError();

        $this->assertEquals($expected, Country::getError());
    }
}
?>