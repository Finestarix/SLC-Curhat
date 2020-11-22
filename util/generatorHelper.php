<?php

if (!function_exists('generateRandomString')) {
    function generateHashPassword($password)
    {
        $passwordSalt = bin2hex(random_bytes(10));
        $passwordPepper = 'SLC-Curhat';
        $passwordHash = password_hash($passwordPepper . $passwordSalt . $password, PASSWORD_BCRYPT);
        return array($passwordSalt, $passwordHash);
    }
}

if (!function_exists('generateUUID')) {
    function generateUUID()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}

if (!function_exists('generateCSRF')) {
    function generateCSRF()
    {
        try {
            return bin2hex(random_bytes(64));
        } catch (Exception $e) {
        }
    }
}
