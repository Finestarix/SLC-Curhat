<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/secretController.php');
require_once(dirname(__FILE__) . '/core/userController.php');
require_once(dirname(__FILE__) . '/../util/captchaHelper.php');
require_once(dirname(__FILE__) . '/../util/sessionHelper.php');
require_once(dirname(__FILE__) . '/../util/generatorHelper.php');

session_start();

if (!isset($_SESSION['USER']))
    $_SESSION['ERROR'] = 'You must login first !';
else if (!isset($_POST['CSRF_TOKEN']) || !isset($_POST['secret']) || !isset($_POST['g-recaptcha-response']))
    $_SESSION['ERROR'] = 'Invalid request !';
else {
    $captchaResponse = $_POST['g-recaptcha-response'];
    $response = validateCaptcha($captchaResponse);
    if (!$response['success'])
        $_SESSION['ERROR'] = 'Invalid Google Captcha !';
}

if (isset($_SESSION['ERROR'])) {
    header('Location: /');
    die();
}

$secret = new stdClass();
$secret->content = $_POST['secret'];

if (checkToken($_POST['CSRF_TOKEN']))
    $_SESSION['ERROR'] = 'Invalid CSRF Token !';
else if (strlen($secret->content) <= 5 || strlen($secret->content) >= 200)
    $_SESSION['ERROR'] = 'Secret content length must between 5 and 200 characters !';

if (isset($_SESSION['ERROR'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

$secret->id = generateUUID();
$secret->user_id = decryptSession($_SESSION['USER']);

$affectedRow = insertSecret($secret);

if ($affectedRow == 1) {
    updateUserPoint($secret->user_id, 5);
    $_SESSION['SUCCESS'] = 'Success create new secret !';
}
else
    $_SESSION['ERROR'] = 'Failed to insert secret !';

header('Location: ' . $_SERVER['HTTP_REFERER']);




