<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Departament;

$app->get('/departaments/search/:departament_id', function($departament_id) {

    User::verifyLogin();

    echo json_encode(Departament::search($departament_id));
});

$app->get('/departaments', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('departaments', array(
        'departaments' => Departament::listAll(),
        'msgError'  => Departament::getError()
    ));
});

$app->get('/departaments/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('departaments-create', array(
        'msgError'  => Departament::getError()
    ));
});

$app->get('/departaments/:departament_id/delete', function($departament_id) {

    User::verifyLogin();

    $departament = new Departament();

    $departament->get((int)$departament_id);

    $departament->delete();

    header('Location: /departaments');
    die;
});

$app->get('/departaments/:departament_id', function($departament_id) {

    User::verifyLogin();

    $departament = new Departament();

    $departament->get($departament_id);

    $page = new Page();

    $page->setTpl('departaments-update', array(
        'departament'   => $departament->getValues(),
        'msgError'  => Departament::getError()
    ));
});

$app->post('/departaments/create', function() {

    User::verifyLogin();

    $departament = new Departament();

    $departament->setValues($_POST);

    $departament->insert();

    header('Location: /departaments');
    die;
});

$app->post('/departaments/:departament_id', function($departament_id) {

    User::verifyLogin();

    $departament = new Departament();

    $departament->get((int)$departament_id);

    $departament->setValues($_POST);

    $departament->update();

    header('Location: /departaments');
    die;
});
?>