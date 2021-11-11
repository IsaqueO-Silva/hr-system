<?php

session_start();

require_once('vendor/autoload.php');

use \Slim\Slim;
use \Isaque\Page;
use \Isaque\Model\User;

$app = new Slim();

require_once('routes/users.php');
require_once('routes/regions.php');
require_once('routes/countries.php');
require_once('routes/locations.php');
require_once('routes/departments.php');
require_once('routes/jobs.php');
require_once('routes/employees.php');

$app->config('debug', true);

$app->get('/', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('index');
});

$app->run();
?>