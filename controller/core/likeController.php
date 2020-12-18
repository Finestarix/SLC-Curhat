<?php
require_once(dirname(__FILE__) . '/databaseController.php');

if (!function_exists('isUserLike')) {
    function isUserLike($userID, $secretID)
    {
        $connection = getConnection();

        $query = "SELECT * FROM `like_detail` WHERE `user_id` LIKE ? AND `secret_id` LIKE ?";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("ss", $userID, $secretID);
        $preparedStatement->execute();

        $result = $preparedStatement->get_result();

        return $result->fetch_object();
    }
}

if (!function_exists('insertLike')) {
    function insertLike($userID, $secretID)
    {
        $connection = getConnection();

        $query = "INSERT INTO `like_detail` (`user_id`, `secret_id`) VALUES (?, ?)";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("ss", $userID, $secretID);
        $preparedStatement->execute();
    }
}

if (!function_exists('removeLike')) {
    function removeLike($userID, $secretID)
    {
        $connection = getConnection();

        $query = "DELETE FROM `like_detail` WHERE `user_id` LIKE ? AND `secret_id` LIKE ?";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("ss", $userID, $secretID);
        $preparedStatement->execute();
    }
}
