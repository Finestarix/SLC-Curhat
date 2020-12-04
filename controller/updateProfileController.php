<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');
require_once(dirname(__FILE__) . '/../util/captchaHelper.php');

session_start();

if (!isset($_POST['CSRF_TOKEN']) || !isset($_POST['birthdate-day']) || !isset($_POST['birthdate-month']) ||
    !isset($_POST['birthdate-year']) || !isset($_POST['gender']) || !isset($_POST['campus']) ||
    !isset($_POST['g-recaptcha-response'])) {
    $_SESSION['ERROR'] = 'Invalid request !';
    header('Location: /');
    die();
}

$captchaResponse = $_POST['g-recaptcha-response'];
$response = validateCaptcha($captchaResponse);
if (checkToken($_POST['CSRF_TOKEN']))
    $_SESSION['ERROR'] = 'Invalid CSRF Token !';
if (!$response['success'])
    $_SESSION['ERROR'] = 'Invalid Google Captcha !';

if (isset($_SESSION['ERROR'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

$birthdateDay = $_POST['birthdate-day'];
$birthdateMonth = $_POST['birthdate-month'];
$birthdateYear = $_POST['birthdate-year'];

$newBirthdate = $birthdateYear . '-' . $birthdateMonth . '-' . $birthdateDay;
$newGender = (strcmp($_POST['gender'], "male") == 0) ? "Male" : "Female";
$newLocation = (strcasecmp($_POST['campus'], "kemanggisan") == 0) ? "Kemanggisan" :
    ((strcasecmp($_POST['campus'], "alsut") == 0) ? "Alam Sutera" : "Bekasi");

$user = getCurrentUser();
if (strcmp($user->birthdate, $newBirthdate) != 0)
    $user->birthdate = $newBirthdate;
if (strcmp($user->gender, $newGender) != 0)
    $user->gender = $newGender;
if (strcmp($user->location, $newLocation) != 0)
    $user->location = $newLocation;

$affectedRow = updateUserProfile($user);

if ($affectedRow == 1)
    $_SESSION['SUCCESS'] = 'Update profile success !';
else
    $_SESSION['ERROR'] = 'Failed to update profiler !';

header('Location: ' . $_SERVER['HTTP_REFERER']);





