<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');
require_once(dirname(__FILE__) . '/../util/passwordHelper.php');
require_once(dirname(__FILE__) . '/../util/sessionHelper.php');

session_start();

if (isset($_SESSION['USER']))
    $_SESSION['ERROR'] = 'You are already logged in !';
else if (!isset($_POST['CSRF_TOKEN']) || !isset($_POST['identity']) || !isset($_POST['password']))
    $_SESSION['ERROR'] = 'Invalid request !';

if (isset($_SESSION['ERROR'])) {
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

$user = ($userByUsername != NULL) ? $userByUsername : $userByEmail;

if (verifyPassword($user->password_salt, $password, $user->password)) {
    $_SESSION['USER'] = encryptSession($user->id);
} else {
    $_SESSION['ERROR'] = 'Wrong user credentials !';
}

var_dump(decryptSession($_SESSION['USER']));
die();

header('Location: /');



