<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Job;

$app->get('/jobs', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('jobs', array(
        'jobs' => Job::listAll()
    ));
});

$app->get('/jobs/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('jobs-create');
});

$app->get('/jobs/:job_id/delete', function($job_id) {

    User::verifyLogin();

    $job = new Job();

    $job->get((int)$job_id);

    $job->delete();

    header('Location: /jobs');
    die;
});

$app->get('/jobs/:job_id', function($job_id) {

    User::verifyLogin();

    $job = new Job();

    $job->get($job_id);

    $page = new Page();

    $page->setTpl('jobs-update', array(
        'job'  => $job->getValues()
    ));
});

$app->post('/jobs/create', function() {

    User::verifyLogin();

    $job = new Job();

    $job->setValues($_POST);

    $job->save();

    header('Location: /jobs');
    die;
});

$app->post('/jobs/:job_id', function($job_id) {

    User::verifyLogin();

    $job = new Job();

    $job->get((int)$job_id);

    $job->setValues($_POST);

    $job->save();

    header('Location: /jobs');
    die;
});

?>