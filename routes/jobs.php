<?php

use \Isaque\Page;
use \Isaque\Model\User;
use \Isaque\Model\Job;

$app->get('/jobs/search/:job_id', function($job_id) {

    User::verifyLogin();

    echo json_encode(Job::search($job_id));
});

$app->get('/jobs', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('jobs', array(
        'jobs'      => Job::listAll(),
        'msgError'  => Job::getError()
    ));
});

$app->get('/jobs/create', function() {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl('jobs-create', array(
        'msgError' => Job::getError()
    ));
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
        'job'       => $job->getValues(),
        'msgError'  => Job::getError()
    ));
});

$app->post('/jobs/create', function() {

    User::verifyLogin();

    $job = new Job();

    $job->setValues(sanitize($_POST));

    $job->insert();

    header('Location: /jobs');
    die;
});

$app->post('/jobs/:job_id', function($job_id) {

    User::verifyLogin();

    $job = new Job();

    $job->get((int)$job_id);

    $job->setValues(sanitize($_POST));

    $job->update();

    header('Location: /jobs');
    die;
});

?>