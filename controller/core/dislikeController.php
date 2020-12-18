<?php
require_once(dirname(__FILE__) . '/databaseController.php');

if (!function_exists('isUserDislike')) {
    function isUserDislike($userID, $secretID)
    {
        $connection = getConnection();

        $query = "SELECT * FROM `dislike_detail` WHERE `user_id` LIKE ? AND `secret_id` LIKE ?";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("ss", $userID, $secretID);
        $preparedStatement->execute();

        $result = $preparedStatement->get_result();

        return $result->fetch_object();
    }
}

if (!function_exists('insertDislike')) {
    function insertDislike($userID, $secretID)
    {
        $connection = getConnection();

        $query = "INSERT INTO `dislike_detail` (`user_id`, `secret_id`) VALUES (?, ?)";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("ss", $userID, $secretID);
        $preparedStatement->execute();
    }
}

if (!function_exists('removeDislike')) {
    function removeDislike($userID, $secretID)
    {
        $connection = getConnection();

        $query = "DELETE FROM `dislike_detail` WHERE `user_id` LIKE ? AND `secret_id` LIKE ?";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("ss", $userID, $secretID);
        $preparedStatement->execute();
    }
}