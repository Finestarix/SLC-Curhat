<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');
require_once(dirname(__FILE__) . '/../util/passwordHelper.php');

session_start();

if (!isset($_POST['CSRF_TOKEN']) || !isset($_POST['old-password']) || !isset($_POST['new-password']) ||
    !isset($_POST['confirm-new-password'])) {
    $_SESSION['ERROR'] = 'Invalid request !';
    header('Location: /');
    die();
}

$user = getCurrentUser();
$oldPassword = $_POST['old-password'];
$password = $_POST['new-password'];
$confirmPassword = $_POST['confirm-new-password'];

if (!verifyPassword($user->password_salt, $oldPassword, $user->password))
    $_SESSION['ERROR'] = 'Wrong user password !';
else if (strlen($password) <= 5)
    $_SESSION['ERROR'] = 'Password length must more than 5 characters !';
else if (!ctype_alnum($password))
    $_SESSION['ERROR'] = 'Password must be alphanumeric !';
else if (strcmp($password, $confirmPassword) != 0)
    $_SESSION['ERROR'] = 'The password and confirmation password do not match !';

if (isset($_SESSION['ERROR'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

list($user->password_salt, $user->password) = hashPassword($password);

$affectedRow = updateUserPassword($user);

if ($affectedRow == 1)
    $_SESSION['SUCCESS'] = 'Success update your password !';
else
    $_SESSION['ERROR'] = 'Failed to update your password !';

header('Location: ' . $_SERVER['HTTP_REFERER']);
