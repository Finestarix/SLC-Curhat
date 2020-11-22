<?php

require_once(dirname(__FILE__) . '/core/userController.php');

session_start();

$verificationKey = $_GET['key'];

$user = getUserByKey($verificationKey);

//TODO: Add Login Session Validation
//TODO: Check Login Session and $user->id

if ($user == NULL)
    $_SESSION['ERROR'] = 'Invalid Request !';
else if ($user->verified == 1)
    $_SESSION['ERROR'] = 'Your account is already verified !';

if (isset($_SESSION['ERROR'])) {
    header('Location: /');
    die();
}

$affectedRow = updateUserVerified($user);

if ($affectedRow == 1)
    $_SESSION['SUCCESS'] = 'Account verification success !';
else
    $_SESSION['ERROR'] = 'Failed to verify user !';

header('Location: /');



