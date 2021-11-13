<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Employee;

$app->get('/employees/search/:employee_id', function($employee_id) {

    User::verifyLogin();

    echo json_encode(Employee::search($employee_id));
});

$app->get('/employees', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('employees', array(
        'employees' => Employee::listAll(),
        'msgError'  => Employee::getError()
    ));
});

$app->get('/employees/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('employees-create', array(
        'msgError'  => Employee::getError()
    ));
});

$app->get('/employees/:employee_id/delete', function($employee_id) {

    User::verifyLogin();

    $employee = new Employee();

    $employee->get((int)$employee_id);

    $employee->delete();

    header('Location: /employees');
    die;
});

$app->get('/employees/:employee_id', function($employee_id) {

    User::verifyLogin();

    $employee = new Employee();

    $employee->get($employee_id);

    $page = new Page();

    $page->setTpl('employees-update', array(
        'employee'   => $employee->getValues(),
        'msgError'  => Employee::getError()
    ));
});

$app->post('/employees/create', function() {

    User::verifyLogin();

    $employee = new Employee();

    $employee->setValues(sanitize($_POST));

    $employee->insert();

    header('Location: /employees');
    die;
});

$app->post('/employees/:employee_id', function($employee_id) {

    User::verifyLogin();

    $employee = new Employee();

    $employee->get((int)$employee_id);

    $employee->setValues(sanitize($_POST));

    $employee->update();

    header('Location: /employees');
    die;
});
?>