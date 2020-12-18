<?php

require_once(dirname(__FILE__) . '/core/likeController.php');
require_once(dirname(__FILE__) . '/core/dislikeController.php');
require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');

session_start();

if (!isset($_POST['CSRF_TOKEN']) || !(isset($_POST['secretID']))) {
    $_SESSION['ERROR'] = 'Invalid request !';
    header('Location: /');
    die();
}

if (checkToken($_POST['CSRF_TOKEN'])) {
    $_SESSION['ERROR'] = 'Invalid CSRF Token !';
    header('Location: /');
    die();
}

$user = getCurrentUser();
$secretID = $_POST['secretID'];

if (isUserLike($user->id, $secretID)) {
    removeLike($user->id, $secretID);
    insertDislike($user->id, $secretID);
} else if (isUserDislike($user->id, $secretID)) {
    removeDislike($user->id, $secretID);
} else {
    insertDislike($user->id, $secretID);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
