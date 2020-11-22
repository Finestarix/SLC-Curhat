<?php

require_once(dirname(__FILE__) . '/databaseController.php');
require_once(dirname(__FILE__) . '/../../util/uriHelper.php');

checkURI(realpath(__FILE__));

if (!function_exists('getUserByUsername')) {
    function getUserByUsername($username)
    {
        $connection = getConnection();

        $query =  "SELECT * FROM `users` WHERE `username` = ?";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("s", $username);
        $preparedStatement->execute();

        $result = $preparedStatement->get_result();

        return $result->fetch_object();
    }
}

if (!function_exists('insertUser')) {
    function insertUser($user)
    {
        $connection = getConnection();

        $query =  "INSERT INTO `users` (`id`, `username`, `email`, `password`, `password_salt`, 
                    `birthdate`, `gender`, `location`, `point`, `created_at`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("ssssssssis",
            $user->id,
            $user->username,
            $user->email,
            $user->password,
            $user->password_salt,
            $user->birthdate,
            $user->gender,
            $user->location,
            $user->point,
            $user->created_at);
        $prepareStatement->execute();
    }
}