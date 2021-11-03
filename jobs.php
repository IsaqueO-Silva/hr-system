<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Job;

$app->get('/jobs', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('jobs', array(
        'search' => ''
    ));
});
?>