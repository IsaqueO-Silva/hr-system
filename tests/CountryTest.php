<?php

use PHPUnit\Framework\TestCase;
use Isaque\Model\Country;

class CountryTest extends TestCase {
   
    public function testGetCountryFromDatabase() {

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
}
?>