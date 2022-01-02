<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Country;

$app->get('/countries/search/:country_id', function($country_id) {

    User::verifyLogin();

    echo json_encode(Country::search($country_id));
});

$app->get('/countries', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('countries', array(
        'countries' => Country::listAll(),
        'msgError'  => Country::getError()
    ));
});

$app->get('/countries/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('countries-create', array(
        'msgError'  => Country::getError()
    ));
});

$app->get('/countries/:country_id/delete', function($country_id) {

    User::verifyLogin();

    $country = new Country();

    $country->get((int)$country_id);

    $country->delete();

    header('Location: /countries');
    die;
});

$app->get('/countries/:country_id', function($country_id) {

    User::verifyLogin();

    $country = new Country();

    $country->get($country_id);

    $page = new Page();

    $page->setTpl('countries-update', array(
        'country'   => $country->getValues(),
        'msgError'  => Country::getError()
    ));
});

$app->post('/countries/create', function() {

    User::verifyLogin();

    $country = new Country();

    $country->setValues(sanitize($_POST));

    $country->insert();

    header('Location: /countries');
    die;
});

$app->post('/countries/:country_id', function($country_id) {

    User::verifyLogin();

    $country = new Country();

    $country->get((int)$country_id);

    $country->setValues(sanitize($_POST));

    $country->update();

    header('Location: /countries');
    die;
});
?>