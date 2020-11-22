<?php

require_once(dirname(__FILE__) . '/databaseController.php');

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

if (!function_exists('getUserByEmail')) {
    function getUserByEmail($email)
    {
        $connection = getConnection();

        $query =  "SELECT * FROM `users` WHERE `email` = ?";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("s", $email);
        $preparedStatement->execute();

        $result = $preparedStatement->get_result();

        return $result->fetch_object();
    }
}

if (!function_exists('getUserByKey')) {
    function getUserByKey($key)
    {
        $connection = getConnection();

        $query =  "SELECT * FROM `users` WHERE `key` = ?";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("s", $key);
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
                    `birthdate`, `gender`, `location`, `point`, `key`, `verified`, `created_at`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("ssssssssisis",
            $user->id,
            $user->username,
            $user->email,
            $user->password,
            $user->password_salt,
            $user->birthdate,
            $user->gender,
            $user->location,
            $user->point,
            $user->key,
            $user->verified,
            $user->created_at);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}

if (!function_exists('updateUserVerified')) {
    function updateUserVerified($user)
    {
        $connection = getConnection();

        $query =  "UPDATE `users` SET `verified` = 1 WHERE `id` = ?";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("s",$user->id);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}