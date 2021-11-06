<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Job;

$app->get('/jobs/:job_id/delete', function($job_id) {

    User::verifyLogin();

    $job = new Job();

    $job->get((int)$job_id);

    $job->delete();

    header('Location: /jobs');
    die;
});

$app->get('/jobs/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('jobs-create');
});

$app->post('/jobs/create', function() {

    User::verifyLogin();

    $job = new Job();

    $job->setValues($_POST);

    $job->save();

    header('Location: /jobs');
    die;
});

$app->get('/jobs', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('jobs', array(
        'jobs' => Job::listAll()
    ));
});
?>