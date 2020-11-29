<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');
require_once(dirname(__FILE__) . '/../util/passwordHelper.php');
require_once(dirname(__FILE__) . '/../util/captchaHelper.php');
require_once(dirname(__FILE__) . '/../util/generatorHelper.php');

session_start();

if (!isset($_POST['CSRF_TOKEN']) || !isset($_POST['username']) || !isset($_POST['email']) ||
    !isset($_POST['password']) || !isset($_POST['confirm-password']) || !isset($_POST['birthdate-day']) ||
    !isset($_POST['birthdate-month']) || !isset($_POST['birthdate-year']) || !isset($_POST['gender']) ||
    !isset($_POST['campus']) || !isset($_POST['g-recaptcha-response'])) {
    $_SESSION['ERROR'] = 'Invalid request !';
    header('Location: /');
    die();
}

$captchaResponse = $_POST['g-recaptcha-response'];
$response = validateCaptcha($captchaResponse);
if (!$response['success'])
    $_SESSION['ERROR'] = 'Invalid Google Captcha !';

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

if (checkToken($_POST['CSRF_TOKEN']))
    $_SESSION['ERROR'] = 'Invalid CSRF Token !';
else if (strlen($user->username) <= 5)
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

if (isset($_SESSION['ERROR'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

$user->verified = 0;
$user->point = 0;

$user->id = generateUUID();
$user->key = generateRandom(20);

list($user->password_salt, $user->password) = hashPassword($user->password);

date_default_timezone_set('Asia/Jakarta');
$user->created_at = date('Y-m-d H:i:s');

$affectedRow = insertUser($user);

if ($affectedRow == 1) {
    $_SESSION['SUCCESS'] = 'Register success ! Please check your email !';

    $subject = "Email Verification";
    $message = "<style> * { margin: 0; padding: 0; }</style><table style='width: 100%; background-color: #f5f7f9;'> <tr> <td style='align-content: center;'> <table style='width: 100%;'> <tr> <td style='padding: 25px 0;text-align: center;'> <p style='color: #839197; font-size: 30px; font-weight: bold;'>SLC-Curhat</p> </td> </tr> <tr> <td style='width: 100%; border-top: 1px solid #e7eaec; border-bottom: 1px solid #e7eaec; background-color: #ffffff;'> <table style='align-content: center; width: 570px; margin: 0 auto;'> <tr> <td style='padding: 35px;'> <h1 style='color: #292e31; font-size: 19px; font-weight: bold; text-align: left;'> Thanks for signing up for SLC-Curhat !</h1> <table style='width: 100%; margin: 30px auto; padding: 0; text-align: center;'> <tr> <td style='align-content: center'> <a style='color: #ffffff; font-size: 15px; line-height: 45px; text-align: center; display: inline-block; width: 200px; background-color: #414ef9; border-radius: 3px; text-decoration: none;' href='http://localhost:8080/verification?key=$user->key'> Click Here to Verify Email </a> </td> </tr> </table> </td> </tr> </table> </td> </tr> <tr> <td> <table style='width: 570px; margin: 0 auto; padding: 0; text-align: center;'> <tr> <td style='padding: 35px;'> <p style='color: #839197; font-size: 12px; line-height: 1.5em; text-align: center;'> SLC-Curhat, Inc. <br> Software Laboratory Center, Bina Nusantara University </p> </td> </tr> </table> </td> </tr> </table> </td> </tr></table>";
    $headers = "From: slc-curhat@gmail.com \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($user->email, $subject, $message, $headers);
} else
    $_SESSION['ERROR'] = 'Failed to insert user !';

header('Location: ' . $_SERVER['HTTP_REFERER']);




