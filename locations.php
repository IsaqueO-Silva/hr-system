<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Location;

$app->get('/locations/search/:location_id', function($location_id) {

    User::verifyLogin();

    echo json_encode(Location::search($location_id));
});

$app->get('/locations', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('locations', array(
        'locations' => Location::listAll(),
        'msgError'  => Location::getError()
    ));
});

$app->get('/locations/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('locations-create', array(
        'msgError' => Location::getError()
    ));
});

$app->get('/locations/:location_id/delete', function($location_id) {

    User::verifyLogin();

    $location = new Location();

    $location->get((int)$location_id);

    $location->delete();

    header('Location: /locations');
    die;
});

$app->get('/locations/:location_id', function($location_id) {

    User::verifyLogin();

    $location = new Location();

    $location->get($location_id);

    $page = new Page();

    $page->setTpl('locations-update', array(
        'location'  => $location->getValues(),
        'msgError'  => Location::getError()
    ));
});

$app->post('/locations/create', function() {

    User::verifyLogin();

    $location = new Location();

    $location->setValues($_POST);

    $location->insert();

    header('Location: /locations');
    die;
});

$app->post('/locations/:location_id', function($location_id) {

    User::verifyLogin();

    $location = new Location();

    $location->get((int)$location_id);

    $location->setValues($_POST);

    $location->update();

    header('Location: /locations');
    die;
});
?>