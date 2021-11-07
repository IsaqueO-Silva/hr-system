<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Region;

$app->get('/regions/search/:region_id', function($region_id) {

    User::verifyLogin();

    echo json_encode(Region::search($region_id));
});

$app->get('/regions', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('regions', array(
        'regions'   => Region::listAll(),
        'msgError'  => Region::getError()
    ));
});

$app->get('/regions/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('regions-create', array(
        'msgError' => Region::getError()
    ));
});

$app->get('/regions/:region_id/delete', function($region_id) {

    User::verifyLogin();

    $region = new Region();

    $region->get((int)$region_id);

    $region->delete();

    header('Location: /regions');
    die;
});

$app->get('/regions/:region_id', function($region_id) {

    User::verifyLogin();

    $region = new Region();

    $region->get($region_id);

    $page = new Page();

    $page->setTpl('regions-update', array(
        'region'    => $region->getValues(),
        'msgError'  => Region::getError()
    ));
});

$app->post('/regions/create', function() {

    User::verifyLogin();

    $region = new Region();

    $region->setValues($_POST);

    $region->insert();

    header('Location: /regions');
    die;
});

$app->post('/regions/:region_id', function($region_id) {

    User::verifyLogin();

    $region = new Region();

    $region->get((int)$region_id);

    $region->setValues($_POST);

    $region->update();

    header('Location: /regions');
    die;
});
?>