<?php

class RoutingController {

    public function index() {
        include 'index.php';
    }

    public function initialize() {
        include 'initialize.php';
    }

    public function loginController() {
        include 'controller/loginController.php';
    }

    public function register() {
        include 'register.php';
    }

    public function registerController() {
        include 'controller/registerController.php';
    }

    public function logout() {
        include 'controller/logoutController.php';
    }

    public function verification() {
        include 'controller/verificationController.php';
    }

    public function storeSecret() {
        include 'controller/addSecretController.php';
    }

}