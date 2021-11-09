<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Department;

$app->get('/departments/search/:department_id', function($department_id) {

    User::verifyLogin();

    echo json_encode(Department::search($department_id));
});

$app->get('/departments', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('departments', array(
        'departments'   => Department::listAll(),
        'msgError'      => Department::getError()
    ));
});

$app->get('/departments/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('departments-create', array(
        'msgError'  => Department::getError()
    ));
});

$app->get('/departments/:department_id/location', function($department_id) {

    User::verifyLogin();

    $department = new Department();

    $department->get((int)$department_id);

    $page = new Page();

    $page->setTpl('location', array(
        'department' => $department->getValues()
    ));
});

$app->get('/departments/:department_id/delete', function($department_id) {

    User::verifyLogin();

    $department = new Department();

    $department->get((int)$department_id);

    $department->delete();

    header('Location: /departments');
    die;
});

$app->get('/departments/:department_id', function($department_id) {

    User::verifyLogin();

    $department = new Department();

    $department->get($department_id);

    $page = new Page();

    $page->setTpl('departments-update', array(
        'department'    => $department->getValues(),
        'msgError'      => Department::getError()
    ));
});

$app->post('/departments/create', function() {

    User::verifyLogin();

    $department = new Department();

    $department->setValues($_POST);

    $department->insert();

    header('Location: /departments');
    die;
});

$app->post('/departments/:department_id', function($department_id) {

    User::verifyLogin();

    $department = new Department();

    $department->get((int)$department_id);

    $department->setValues($_POST);

    $department->update();

    header('Location: /departments');
    die;
});
?>