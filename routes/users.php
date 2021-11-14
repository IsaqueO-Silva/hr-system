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
?>