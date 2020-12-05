<?php

require_once(dirname(__FILE__) . '/databaseController.php');

if (!function_exists('getMySecret')) {
    function getMySecret()
    {
        $connection = getConnection();

        $query = "SELECT * FROM `secret` WHERE `user_id` = ? ORDER BY `created_at` DESC";

        $id = decryptSession($_SESSION['USER']);
        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bind_param("s", $id);
        $preparedStatement->execute();

        return $preparedStatement->get_result();
    }
}

if (!function_exists('insertSecret')) {
    function insertSecret($secret)
    {
        $connection = getConnection();

        $query =  "INSERT INTO `secret` (`id`, `user_id`, `content`) VALUES (?, ?, ?)";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("sss",
            $secret->id,
            $secret->user_id,
            $secret->content);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}