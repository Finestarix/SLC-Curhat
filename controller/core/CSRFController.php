<?php

require_once(dirname(__FILE__) . '/../../util/generatorHelper.php');

if (!function_exists('regenerateToken')) {
    function regenerateToken()
    {
        $_SESSION["CSRF_TOKEN"] = generateRandom(64);
    }
}

if (!function_exists('getToken')) {
    function getToken()
    {
        return $_SESSION["CSRF_TOKEN"];
    }
}

if (!function_exists('checkToken')) {
    function checkToken($passToken)
    {
        return $passToken != $_SESSION["CSRF_TOKEN"];
    }
}