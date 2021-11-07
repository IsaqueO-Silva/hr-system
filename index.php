<?php

session_start();

require_once('vendor/autoload.php');

use \Slim\Slim;
use \Isaque\Page;
use \Isaque\Model\User;

$app = new Slim();

require_once('users.php');
require_once('regions.php');
require_once('countries.php');
require_once('locations.php');
require_once('jobs.php');

$app->config('debug', true);

$app->get('/', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('index');
});

$app->run();
?>