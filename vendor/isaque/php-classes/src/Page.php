<?php

namespace Isaque;

use Rain\Tpl;
use \Isaque\Model\User;

class Page {

    private $tpl;
    private $options    = array();
    private $defaults   = array(
        'header'    => true,
        'footer'    => true,
        'data'      => array()
    );

    public function __construct($opts = array(), $tpl_dir = '/views/') {

        $this->options = array_merge($this->defaults, $opts);

        if(isset($_SESSION[User::SESSION])) {

            /* Capturing user name/job from the session variable */
            $this->options['data']['name']  = $_SESSION[User::SESSION]['fist_name'].' '.$_SESSION[User::SESSION]['last_name'];
            $this->options['data']['job']   = $_SESSION[User::SESSION]['job_title'];
        }

        $config = array(
            'tpl_dir'       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
            'cache_dir'     => $_SERVER['DOCUMENT_ROOT'].'/views-cache/',
            'debug'         => false
        );

        Tpl::configure($config);

        $this->tpl = new Tpl();

        $this->setData($this->options['data']);

        if($this->options['header'] === true) $this->tpl->draw('header');
    }

    private function setData($data = array()) {

        foreach($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    public function setTpl($name, $data = array(), $returnHTML = false) {

        $this->setData($data);

        $this->tpl->draw($name, $returnHTML);
    }

    public function __destruct() {

        if($this->options['footer'] === true) $this->tpl->draw('footer');
    }
}
?>