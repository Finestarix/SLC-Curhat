<?php

if (!function_exists('encryptSession')) {
    function encryptSession($session)
    {
        $cipherType = "AES-128-CTR";
        $cipherIVKey = "1921921921921921";
        $cipherOption = 0;
        $cipherKey = "SLC-Curhat";

        return openssl_encrypt($session, $cipherType, $cipherKey, $cipherOption, $cipherIVKey);
    }
}

if (!function_exists('decryptSession')) {
    function decryptSession($session)
    {
        $cipherType = "AES-128-CTR";
        $cipherIVKey = "1921921921921921";
        $cipherOption = 0;
        $cipherKey = "SLC-Curhat";

        return openssl_decrypt ($session, $cipherType, $cipherKey, $cipherOption, $cipherIVKey);
    }
}