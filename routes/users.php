<?php

use \Isaque\Page;
use \Isaque\Model\User;

$app->get('/login', function() {

    $page = new Page(array(
        'header'    => false,
        'footer'    => false
    ));

    $page->setTpl('login');
});

$app->post('/login', function() {

    User::login($_POST['login'], $_POST['password']);

    header('Location: /');
    die;
});

$app->get('/logout', function() {

    User::logout();

    header('Location: /');
    die;
});

$app->get('/forgot', function() {

    $page = new Page(array(
        'header'    => false,
        'footer'    => false
    ));

    $page->setTpl('forgot');
});

$app->post('/forgot', function() {

    $_POST = sanitize($_POST);

    User::getForgot($_POST['email']);

    header('Location: /forgot/sent');
    die;
});

$app->get('/forgot/sent', function() {

    $page = new Page(array(
        'header'    => false,
        'footer'    => false
    ));

    $page->setTpl('forgot-sent');
});

$app->get('/forgot/reset', function() {

    $user = User::validForgotDecrypt($_GET['code']);

    $page = new Page(array(
        'header'    => false,
        'footer'    => false
    ));

    $page->setTpl('forgot-reset', array(
        'name'	=> $user['fist_name'].' '.$user['last_name'],
		'code'	=> $_GET['code']
    ));
});

$app->post('/forgot/reset', function() {




    $data = User::validForgotDecrypt($_POST['code']);

    User::setForgotUsed($data['recovery_id']);

    $user = new User();

    $user->get((int)$data['user_id']);

    $password = $_POST['password'];

    $user->updatePassword($password);

    $page = new Page(array(
        'header'    => false,
        'footer'    => false
    ));

    $page->setTpl('forgot-reset-success');
});
?>