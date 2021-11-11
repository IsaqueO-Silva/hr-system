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

$app->get('/users', function() {

    User::verifyLogin();

    $page = new Page();

    $page('users', array(
        'users' => User::listAll(),
        'msgError'  => Location::getError()
    ));
});
?>