<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');

require_once(dirname(__FILE__) . '/../util/generatorHelper.php');
require_once(dirname(__FILE__) . '/../util/uriHelper.php');

checkURI(realpath(__FILE__));

session_start();

if (checkToken($_POST['CSRF_TOKEN']))
    $_SESSION['ERROR'] = 'Invalid CSRF Token !';

$birthdateDay = $_POST['birthdate-day'];
$birthdateMonth = $_POST['birthdate-month'];
$birthdateYear = $_POST['birthdate-year'];
$confirmPassword = $_POST['confirm-password'];
$termsCondition = $_POST['terms-condition'];

$user = new stdClass();
$user->username = $_POST['username'];
$user->email = $_POST['email'];
$user->password = $_POST['password'];
$user->birthdate = $birthdateYear . '-' . $birthdateMonth . '-' . $birthdateDay;
$user->gender = (strcmp($_POST['gender'], "male") == 0) ? "Male" : "Female";
$user->location = (strcmp($_POST['campus'], "kemanggisan") == 0) ? "Kemanggisan" :
    (strcmp($_POST['campus'], "alsut") == 0) ? "Alam Sutera" : "Bekasi";

if (!isset($user->username) || !isset($user->email) || !isset($user->password) || !isset($confirmPassword) ||
    !isset($birthdateDay) || !isset($birthdateMonth) || !isset($birthdateYear) ||
    !isset($user->gender) || !isset($user->location))
    $_SESSION['ERROR'] = 'All field must be filled !';
else {
    if (strlen($user->username) <= 5)
        $_SESSION['ERROR'] = 'Username length must more than 5 characters !';
    else if (getUserByUsername($user->username) != NULL)
        $_SESSION['ERROR'] = 'Username must be unique !';
    else if (!filter_var($user->email, FILTER_VALIDATE_EMAIL))
        $_SESSION['ERROR'] = 'Invalid email format !';
    else if (strlen($user->password) <= 5)
        $_SESSION['ERROR'] = 'Password length must more than 5 characters !';
    else if (!ctype_alnum($user->password))
        $_SESSION['ERROR'] = 'Password must be alphanumeric !';
    else if (strcmp($user->password, $confirmPassword) != 0)
        $_SESSION['ERROR'] = 'The password and confirmation password do not match !';
    else if (!checkdate($birthdateMonth, $birthdateDay, $birthdateYear))
        $_SESSION['ERROR'] = 'Invalid birthdate !';
    else if (strcmp($user->gender, "Male") != 0 &&
                strcmp($user->gender, "Female") != 0)
        $_SESSION['ERROR'] = 'Invalid gender !';
    else if (strcmp($user->location, "Kemanggisan") != 0 &&
                strcmp($user->location, "Alam Sutera") != 0 &&
                strcmp($user->location, "Bekasi") != 0)
        $_SESSION['ERROR'] = 'Invalid campus location !';
    else if ($termsCondition == NULL)
        $_SESSION['ERROR'] = 'Please accept out terms and agreement !';
}

if (isset($_SESSION['ERROR'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

$user->id = generateUUID();
$user->point = 0;
list($user->password_salt, $user->password) = generateHashPassword($user->password);

date_default_timezone_set('Asia/Jakarta');
$user->created_at = date('Y-m-d H:i:s');

insertUser($user);

$_SESSION['SUCCESS'] = 'Register Success !';

header('Location: ' . $_SERVER['HTTP_REFERER']);




