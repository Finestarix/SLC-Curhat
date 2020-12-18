<?php

require_once(dirname(__FILE__) . '/databaseController.php');

if (!function_exists('getHotSecret')) {
    function getHotSecret()
    {
        $connection = getConnection();

        $query = "SELECT secret.id, secret.user_id, secret.content, secret.created_at,
                        likeDataOut.totalLike, dislikeDataOut.totalDislike
                    FROM secret, (
                        SELECT secret.id, dislikeDataIn.totalDislike AS totalDislike
                        FROM ( 
                            SELECT secret.id, COUNT(*) AS totalDislike 
                            FROM secret JOIN dislike_detail
                            WHERE dislike_detail.secret_id = secret.id 
                            GROUP BY secret.id 
                        ) AS dislikeDataIn
                        RIGHT JOIN secret ON secret.id = dislikeDataIn.id
                    ) AS dislikeDataOut, (
                        SELECT secret.id, likeDataIn.totalLike AS totalLike
                        FROM ( 
                            SELECT secret.id, COUNT(*) AS totalLike 
                            FROM secret JOIN like_detail
                            WHERE like_detail.secret_id = secret.id 
                            GROUP BY secret.id 
                        ) AS likeDataIn
                        RIGHT JOIN secret ON secret.id = likeDataIn.id
                    ) AS likeDataOut
                    WHERE secret.id = likeDataOut.id AND likeDataOut.id = dislikeDataOut.id
                    ORDER BY likeDataOut.totalLike DESC, dislikeDataOut.totalDislike ASC";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->execute();

        return $preparedStatement->get_result();
    }
}

if (!function_exists('getNewSecret')) {
    function getNewSecret()
    {
        $connection = getConnection();

        $query = "SELECT secret.id, secret.user_id, secret.content, secret.created_at,
                        likeDataOut.totalLike, dislikeDataOut.totalDislike
                    FROM secret, (
                        SELECT secret.id, dislikeDataIn.totalDislike AS totalDislike
                        FROM ( 
                            SELECT secret.id, COUNT(*) AS totalDislike 
                            FROM secret JOIN dislike_detail
                            WHERE dislike_detail.secret_id = secret.id 
                            GROUP BY secret.id 
                        ) AS dislikeDataIn
                        RIGHT JOIN secret ON secret.id = dislikeDataIn.id
                    ) AS dislikeDataOut, (
                        SELECT secret.id, likeDataIn.totalLike AS totalLike
                        FROM ( 
                            SELECT secret.id, COUNT(*) AS totalLike 
                            FROM secret JOIN like_detail
                            WHERE like_detail.secret_id = secret.id 
                            GROUP BY secret.id 
                        ) AS likeDataIn
                        RIGHT JOIN secret ON secret.id = likeDataIn.id
                    ) AS likeDataOut
                    WHERE secret.id = likeDataOut.id AND likeDataOut.id = dislikeDataOut.id
                    ORDER BY `created_at` DESC";

        $preparedStatement = $connection->prepare($query);
        $preparedStatement->execute();

        return $preparedStatement->get_result();
    }
}

if (!function_exists('getMySecret')) {
    function getMySecret()
    {
        $connection = getConnection();

        $query = "SELECT secret.id, secret.user_id, secret.content, secret.created_at,
                        likeDataOut.totalLike, dislikeDataOut.totalDislike
                    FROM `secret`, (
                        SELECT secret.id, dislikeDataIn.totalDislike AS totalDislike
                        FROM ( 
                            SELECT secret.id, COUNT(*) AS totalDislike 
                            FROM secret JOIN dislike_detail
                            WHERE dislike_detail.secret_id = secret.id 
                            GROUP BY secret.id 
                        ) AS dislikeDataIn
                        RIGHT JOIN secret ON secret.id = dislikeDataIn.id
                    ) AS dislikeDataOut, (
                        SELECT secret.id, likeDataIn.totalLike AS totalLike
                        FROM ( 
                            SELECT secret.id, COUNT(*) AS totalLike 
                            FROM secret JOIN like_detail
                            WHERE like_detail.secret_id = secret.id 
                            GROUP BY secret.id 
                        ) AS likeDataIn
                        RIGHT JOIN secret ON secret.id = likeDataIn.id
                    ) AS likeDataOut
                    WHERE secret.id = likeDataOut.id AND likeDataOut.id = dislikeDataOut.id AND `user_id` = ? 
                    ORDER BY `created_at` DESC";

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

        $query = "INSERT INTO `secret` (`id`, `user_id`, `content`) VALUES (?, ?, ?)";

        $prepareStatement = $connection->prepare($query);
        $prepareStatement->bind_param("sss",
            $secret->id,
            $secret->user_id,
            $secret->content);
        $prepareStatement->execute();

        return $prepareStatement->affected_rows;
    }
}