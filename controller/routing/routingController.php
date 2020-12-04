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

    public function verification() {
        include 'controller/verificationController.php';
    }

    public function logout() {
        include 'controller/logoutController.php';
    }

    public function profile() {
        include 'profile.php';
    }

    public function settings() {
        include 'settings.php';
    }

    public function storeSecret() {
        include 'controller/addSecretController.php';
    }

    public function updateProfile() {
        include 'controller/updateProfileController.php';
    }

    public function updateAvatar() {
        include 'controller/updateAvatarController.php';
    }

    public function updatePassword() {
        include 'controller/updatePasswordController.php';
    }

}