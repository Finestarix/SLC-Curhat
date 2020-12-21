<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');
require_once(dirname(__FILE__) . '/../util/generatorHelper.php');

session_start();

if (!isset($_SESSION['USER']))
    $_SESSION['ERROR'] = 'Login first !';
else if (!isset($_POST['CSRF_TOKEN']) || !(isset($_POST['avatar_user']) || isset($_FILES['avatar'])))
    $_SESSION['ERROR'] = 'Invalid request !';
else if (checkToken($_POST['CSRF_TOKEN']))
    $_SESSION['ERROR'] = 'Invalid CSRF Token !';

if (isset($_SESSION['ERROR'])) {
    header('Location: /');
    die();
}

$user = getCurrentUser();
$affectedRow = 0;

if (isset($_POST['avatar_user'])) {

    if (strcasecmp($user->image_path, $_POST['avatar_user']) == 0) {
        $_SESSION['ERROR'] = 'Please choose different avatar !';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }

    $user->image_path = "avatar_" . $_POST['avatar_user'] . ".png";

    $affectedRow = updateUserAvatar($user);

} else if (isset($_FILES['avatar'])) {
    $allowedExtension = array('gif', 'png', 'jpg');

    if (empty($_FILES['avatar']['name']))
        $_SESSION['ERROR'] = 'Avatar can\'t be empty !';
    else if (!in_array(strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION)), $allowedExtension))
        $_SESSION['ERROR'] = 'Avatar extension must be image file (gif, png, jpg) !';
    else if ($_FILES['avatar']['size'] > 2097152 )
        $_SESSION['ERROR'] = 'Avatar size must be less than 2MB !';

    if (isset($_SESSION['ERROR'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }

    $filename = generateUUID() . "." . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $directoryTarget = 'assets/images/avatar/external/' . $filename;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $directoryTarget);

    $user->image_path = "external/" . $filename;
    $affectedRow = updateUserAvatar($user);
}

if ($affectedRow == 1)
    $_SESSION['SUCCESS'] = 'Success update your avatar !';
else
    $_SESSION['ERROR'] = 'Failed to update your avatar !';

header('Location: ' . $_SERVER['HTTP_REFERER']);

