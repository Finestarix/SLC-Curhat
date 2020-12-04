<?php

require_once('util/uriHelper.php');
require_once('util/reportHelper.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('component/header.php') ?>
</head>
<body class="bg-light">
<div class="container-fluid mt-3 mb-3">
    <header class="text-center mb-3">
        <h1 class="title">SLC Curhat Initialization Script</h1>
    </header>
    <article>
        <?php

        $reportPreflightName = 'Preflight Report';
        $reportSQLConnectName = 'MySQLi Connect Report';
        $reportSQLDropName = 'Table Schema Dropping Report';
        $reportSQLCreateName = 'Table Schema Creation Report';
        $reportSQLPreparationName = 'Statement Preparation Report';
        $reportSeederName = 'Table Seeder Report';
        $reportGenerateName = 'Initialization Completed';

        $isAlreadyInitialized = false;
        $isForce = false;

        $databaseRoot = 'information_schema';
        $databaseConfig = require_once('config/databaseConfig.php');

        $preflightConnection = new mysqli(
            $databaseConfig['HOST'],
            $databaseConfig['USERNAME'],
            $databaseConfig['PASSWORD'],
            $databaseRoot,
            $databaseConfig['PORT']
        );

        if ($preflightConnection->connect_error) {
            $errorMessage = 'Pre-initialization connect failed: ' . $preflightConnection->connect_error;
            die(createReport($reportPreflightName, $errorMessage));
        }

        $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS " . $databaseConfig['DATABASE_NAME'] .
            " DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
        $preflightConnection->query($createDatabaseQuery);

        $preflightConnection->select_db($databaseConfig['DATABASE_NAME']);

        $initializeQuery = "SELECT `value` FROM app_config WHERE `key` = 'initialized' AND value = 1";
        $initializeResult = $preflightConnection->query($initializeQuery);
        if ($initializeResult) {
            $fetchResult = $initializeResult->fetch_assoc();
            if ($fetchResult && $fetchResult['value'])
                $isAlreadyInitialized = true;
        }

        $preflightConnection->close();

        if ($isAlreadyInitialized) {

            $isRequestForce = isset($_REQUEST['force']);

            if ($isRequestForce) {
                $successMessage = "Data has been initialized. Force initialization is issued. This initialization script will re-initialize the application.";
                echo createReport($reportPreflightName, $successMessage);

                $isForce = true;
            } else {
                $URI = '/';

                $successMessage = "Data has been initialized. Please add force parameter if you want to re-initialize the application.";
                $otherMessage = sprintf(
                    "<a href='?force' class='btn btn-warning mt-2'>Force Initialization</a>
                     <a href='%s' class='btn btn-primary mt-2'>Open Website</a>", $URI
                );

                echo createReport($reportPreflightName, [$successMessage, $otherMessage]);
            }
        } else {
            $successMessage = "Application is ready for initialization.";
            echo createReport($reportPreflightName, $successMessage);
        }

        if (!$isAlreadyInitialized || $isForce) {

            $connectionCharset = 'utf8';

            $connection = new mysqli(
                $databaseConfig['HOST'],
                $databaseConfig['USERNAME'],
                $databaseConfig['PASSWORD'],
                $databaseConfig['DATABASE_NAME'],
                $databaseConfig['PORT']
            );
            $connection->set_charset($connectionCharset);

            if ($connection->connect_error) {
                $errorMessage = "Failed to connect to config: " . $connection->connect_error;
                die(createReport($reportSQLConnectName, $errorMessage));
            }

            $errorMessage = "Successfully established config connection to " . $databaseConfig['DATABASE_NAME'] .
                "@" . $databaseConfig['HOST'] . " with username " . $databaseConfig['USERNAME'];
            echo createReport($reportSQLConnectName, $errorMessage);

            $tableName = "2 tables (app_config, users)";

            $tableDropQueries = [
                "DROP TABLE IF EXISTS `app_config`",
                "DROP TABLE IF EXISTS `secret`",
                "DROP TABLE IF EXISTS `users`",
            ];

            $tableCreateQueries = [
                "CREATE TABLE `app_config` (
                    `key` VARCHAR(15),
                    `value` BOOLEAN,
                    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`key`)
                ) CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;",
                "CREATE TABLE `users` (
                    `id` CHAR(40) NOT NULL,
                    `username` VARCHAR(255) NOT NULL,
                    `email` VARCHAR(255) NOT NULL,
                    `password` VARCHAR(255) NOT NULL,
                    `password_salt` VARCHAR(255) NOT NULL,
                    `birthdate` DATE NOT NULL,
                    `gender` VARCHAR(6) NOT NULL,
                    `location` VARCHAR(12) NOT NULL,
                    `point` INT NOT NULL,
                    `key` VARCHAR(100) NOT NULL,
                    `verified` TINYINT NOT NULL,
                    `image_path` VARCHAR(100) NOT NULL,
                    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`)
                ) CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;",
                "CREATE TABLE `secret` (
                    `id` CHAR(40) NOT NULL,
                    `user_id` VARCHAR(40) NOT NULL,
                    `content` VARCHAR(255) NOT NULL,
                    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
                ) CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;",
            ];

            $tableInsertQueries = [
                'INSERT INTO `app_config` (`key`, `value`) VALUES (?, ?)',
                'INSERT INTO `users` (`id`, `username`, `email`, `password`, `password_salt`, 
                 `birthdate`, `gender`, `location`, `point`, `key`, `verified`, `image_path`) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                'INSERT INTO `secret` (`id`, `user_id`, `content`) VALUES (?, ?, ?)',
            ];

            foreach ($tableDropQueries as $tableDropQuery)
                if (!$connection->query($tableDropQuery)) {
                    $errorMessage = "Drop tables failed: " . $connection->error;
                    die(createReport($reportSQLDropName, $errorMessage));
                }

            $successMessage = "Successfully drops all " . $tableName;
            echo createReport($reportSQLDropName, $successMessage);

            foreach ($tableCreateQueries as $tableCreateQuery)
                if (!$connection->query($tableCreateQuery)) {
                    $errorMessage = "Table creation failed: " . $connection->error;
                    die(createReport($reportSQLCreateName, $errorMessage));
                }

            $successMessage = "Successfully creates all " . $tableName;
            echo createReport($reportSQLCreateName, $successMessage);

            $appConfigSeeder = [
                [
                    'si',
                    'initialized',
                    true
                ]
            ];

            $userSeeder = [
                [
                    'ssssssssssis',
                    '242f6b8c-1b3b-4c13-9394-412778e58ec1',
                    'Finestarix',
                    'irenaldyleonarto@gmail.com',
                    '$2y$10$/c14jpF0mw9ZBpGSNFGUTe4S16vW1vghnyPqBZUo/K2GKyhYaFjP6',
                    'e9c85e8ef7d73a97b5e4',
                    '2000-10-03',
                    'Male',
                    'Kemanggisan',
                    15000,
                    '7102845f8c1425ba8503419208134f5816dda90d',
                    1,
                    'avatar_5.png'
                ]
            ];

            $secretSeeder = [
                [
                    'sss',
                    'db90a3ec-271e-4b87-9404-7163d6c1ff24',
                    '242f6b8c-1b3b-4c13-9394-412778e58ec1',
                    'Content 1',
                ],
                [
                    'sss',
                    'e6b889aa-d4bc-482f-87ae-00ab304b894c',
                    '242f6b8c-1b3b-4c13-9394-412778e58ec1',
                    'Content 2',
                ],
                [
                    'sss',
                    '639350b2-5a2c-41f2-a1d1-ff004cf4a0ed',
                    '242f6b8c-1b3b-4c13-9394-412778e58ec1',
                    'Content 3',
                ]
            ];

            $initializeDatas = [
                [
                    $tableInsertQueries[0],
                    $appConfigSeeder
                ],
                [
                    $tableInsertQueries[1],
                    $userSeeder
                ],
                [
                    $tableInsertQueries[2],
                    $secretSeeder
                ],
            ];

            foreach ($initializeDatas as $initializeData) {

                $query = $initializeData[0];
                $datas = $initializeData[1];

                foreach ($datas as $data) {
                    $preparedStatement = $connection->prepare($query);

                    if (!$preparedStatement) {
                        $errorMessage = "Statement preparation failed: " . $connection->error;
                        die(createReport($reportSQLPreparationName, $errorMessage));
                    }

                    $params = [];
                    for ($i = 0; $i < count($data); $i++)
                        $params[] = &$data[$i];

                    call_user_func_array([$preparedStatement, "bind_param"], $params);

                    $preparedStatement->execute();
                    $preparedStatement->close();
                }
            }

            $connection->close();

            $successMessage = "Statement preparation successful";
            echo createReport($reportSQLPreparationName, $successMessage);

            echo createReport($reportSeederName, [
                "Users data entered (" . count($userSeeder) . " data(s))",
            ]);

            echo createReport($reportSeederName, [
                "Secret data entered (" . count($secretSeeder) . " data(s))",
            ]);

            $URI = '/';

            $successMessage = "Initialization Database Complete";
            $otherMessage = sprintf(
                "<a href='%s' class='btn btn-primary mt-2'>Open Website</a>", $URI
            );

            echo createReport($reportGenerateName, [$successMessage, $otherMessage]);
        }
        ?>
    </article>
</body>
</html>
