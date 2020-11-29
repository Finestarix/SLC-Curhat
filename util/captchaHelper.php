<?php

if (!function_exists('validateCaptcha')) {
    function validateCaptcha($response)
    {
        $URL = "https://www.google.com/recaptcha/api/siteverify";
        $secret = "6LeBneUZAAAAAFi25so5K-h-mhfpNB1PUHZyZeKI";
        $remoteIP = $_SERVER['REMOTE_ADDR'];

        $filename = $URL . "?secret=" . $secret . "&response=" . $response . "&remoteip=" . $remoteIP;

        return json_decode(file_get_contents($filename), true);
    }
}