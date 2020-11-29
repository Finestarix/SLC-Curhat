<?php

require_once(dirname(__FILE__) . '/databaseController.php');

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