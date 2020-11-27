<?php

session_start();

if (isset($_SESSION['USER']))
    unset($_SESSION['USER']);
else
    $_SESSION['ERROR'] = "Please log in first !";

header('Location: /');
