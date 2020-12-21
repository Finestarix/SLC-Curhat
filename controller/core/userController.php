<?php

require_once(dirname(__FILE__) . '/databaseController.php');
require_once(dirname(__FILE__) . '/../../util/sessionHelper.php');

if (!function_exists('getAllUser')) {
    function getAllUser()
    {
        $connection = getConnection();

        $query = "SELECT `username`, `created_at`, `gender`, `point`, `image_path` FROM `users`";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->execute();

        return $preparedStatement->get_result();
    }
}

if (!function_exists('getUserByUsername')) {
    function getUserByUsername($username)
    {
        $connection = getConnection();

        $query = "SELECT * FROM `users` WHERE `username` = ?";

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

        $query = "SELECT * FROM `users` WHERE `email` = ?";

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

        $query = "SELECT * FROM `users` WHERE `key` = ?";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("s", $key);
        $preparedStatement->execute();

        $result = $preparedStatement->get_result();

        return $result->fetch_object();
    }
}

if (!function_exists('getCurrentUser')) {
    function getCurrentUser()
    {
        $connection = getConnection();

        $query = "SELECT * FROM `users` WHERE `id` = ?";

        $id = decryptSession($_SESSION['USER']);
        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("s", $id);
        $preparedStatement->execute();

        $result = $preparedStatement->get_result();

        return $result->fetch_object();
    }
}

if (!function_exists('insertUser')) {
    function insertUser($user)
    {
        $connection = getConnection();

        $query = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `password_salt`, 
                    `birthdate`, `gender`, `location`, `point`, `key`, `verified`, `image_path`) 
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
            $user->image_path);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}

if (!function_exists('updateUserProfile')) {
    function updateUserProfile($user)
    {
        $connection = getConnection();

        $query = "UPDATE `users` SET `birthdate` = ?, `gender` = ?, `location` = ? WHERE `id` = ?";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("ssss",
            $user->birthdate,
            $user->gender,
            $user->location,
            $user->id);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}

if (!function_exists('updateUserAvatar')) {
    function updateUserAvatar($user)
    {
        $connection = getConnection();

        $query = "UPDATE `users` SET `image_path` = ? WHERE `id` = ?";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("ss",
            $user->image_path,
            $user->id);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}


if (!function_exists('updateUserPassword')) {
    function updateUserPassword($user)
    {
        $connection = getConnection();

        $query = "UPDATE `users` SET `password` = ?, `password_salt` = ? WHERE `id` = ?";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("sss",
            $user->password,
            $user->password_salt,
            $user->id);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}

if (!function_exists('updateUserVerified')) {
    function updateUserVerified($user)
    {
        $connection = getConnection();

        $query = "UPDATE `users` SET `verified` = 1 WHERE `id` = ?";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("s", $user->id);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}

if (!function_exists('updateUserPoint')) {
    function updateUserPoint($user_id, $pointAdd)
    {
        $connection = getConnection();
        var_dump($user_id);
        var_dump($pointAdd);

        $query = "UPDATE `users` SET `point` = `point` + ? WHERE `id` = ?";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("is", $pointAdd, $user_id);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}