<?php

require_once('vendor/autoload.php');

use \Slim\Slim;
use \Isaque\Page;

$app = new Slim();

require_once('users.php');

$app->config('debug', true);

$app->get('/', function() {

    $page = new Page();

    $page->setTpl('index');
});

$app->run();
?>