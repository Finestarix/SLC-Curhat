<?php

require_once(dirname(__FILE__) . '/../../util/uriHelper.php');

checkURI(realpath(__FILE__));

class RoutingController {

    public function index() {
        include 'index.php';
    }

    public function initialize() {
        include 'initialize.php';
    }

    public function register() {
        include 'register.php';
    }

}