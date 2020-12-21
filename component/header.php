<?php

if(!isset($_SESSION))
    session_start();

//ini_set('error_reporting', '0');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SLC Curhat</title>

    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link href="/assets/fonts/Lobster-Regular.ttf">

    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/vendor/font-awesome/css/all.css">
    <link rel="stylesheet" href="/vendor/font-awesome/css/v4-shims.css">

    <script src="/vendor/jquery/jquery.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <style>
        * {
            margin: 0;
            padding: 0;

            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
