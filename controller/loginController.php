<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');
require_once(dirname(__FILE__) . '/../util/passwordHelper.php');

session_start();

if (!isset($_POST['CSRF_TOKEN']) || !isset($_POST['identity']) || !isset($_POST['password'])) {
    $_SESSION['ERROR'] = 'Invalid Request !';
    header('Location: /');
    die();
}

$identity = $_POST['identity'];
$password = $_POST['password'];

$userByUsername = getUserByUsername($identity);
$userByEmail = getUserByEmail($identity);

if ($userByUsername == NULL && $userByEmail == NULL) {
    $_SESSION['ERROR'] = 'Invalid Request !';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

if ($userByUsername != NULL) {
    $passwordSalt = $userByUsername->password_salt;
    $passwordHash = $userByUsername->password;
} else if ($userByEmail != NULL) {
    $passwordSalt = $userByEmail->password_salt;
    $passwordHash = $userByEmail->password;
}

if (verifyPassword($passwordSalt, $password, $passwordHash)) {
    $_SESSION['USER'] =
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

var_dump($userByEmail);
var_dump($userByUsername);
die();

