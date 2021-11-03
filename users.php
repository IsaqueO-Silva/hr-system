<?php

use \Isaque\Page;

$app->get('/login', function() {

    $page = new Page(array(
        'header'    => false,
        'footer'    => false
    ));

    $page->setTpl('login');
});
?>