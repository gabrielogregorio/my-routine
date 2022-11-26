<?php

use MyRoutine\Database\MySqlManager;
use MyRoutine\Support\Session;

require __DIR__ . '/../../vendor/autoload.php';

$session = new Session();

if (! $session->logged) {
    header('Location: ' . BASEURL);
}

try {
    $manager = new MySqlManager();
    $mysql = $manager->connect();

    $query = 'UPDATE `tasks` SET `is_checked` = false WHERE `user_id` = ?';

    $stmt = $mysql->prepare($query);
    $stmt->bind_param('i', $userID);

    $userID = $session->userID;

    $stmt->execute();

    header('Location: ' . BASEURL);
} catch (Exception $e) {

}
