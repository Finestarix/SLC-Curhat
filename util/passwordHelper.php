<?php

require_once(dirname(__FILE__) . '/generatorHelper.php');


if (!function_exists('hashPassword')) {
    function hashPassword($password)
    {
        $passwordPepper = 'SLC-Curhat';
        $passwordSalt = generateRandom(10);
        $passwordHash = password_hash($passwordPepper . $passwordSalt . $password, PASSWORD_BCRYPT);
        return array($passwordSalt, $passwordHash);
    }
}

if (!function_exists('verifyPassword')) {
    function verifyPassword($passwordSalt, $password, $passwordHash)
    {
        $passwordPepper = 'SLC-Curhat';
        return password_verify($passwordPepper . $passwordSalt . $password, $passwordHash);
    }
}