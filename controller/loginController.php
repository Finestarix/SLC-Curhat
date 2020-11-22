<?php

require_once(dirname(__FILE__) . '/core/CSRFController.php');
require_once(dirname(__FILE__) . '/core/userController.php');
require_once(dirname(__FILE__) . '/../util/generatorHelper.php');

session_start();

if (checkToken($_POST['CSRF_TOKEN']))
    $_SESSION['ERROR'] = 'Invalid CSRF Token !';


$identity = $_POST['identity'];
$password = $_POST['password'];

var_dump($identity);
var_dump($password);
die();

