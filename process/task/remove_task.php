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

    $query = 'DELETE FROM `tasks` WHERE `task_id` = ? AND `user_id` = ?';

    $stmt = $mysql->prepare($query);
    $stmt->bind_param('ii', $taskID, $userID);

    $taskID = (int)filter_input(INPUT_POST, 'taskID');
    $userID = $session->userID;

    $stmt->execute();
    
    if ($stmt->affected_rows) {
        header('Location: ' . BASEURL);
    } else {
        echo 'Ops, erro ao remover tarefa';
    }

    $stmt->close();
} catch (Exception $e) {
    echo 'Ops, erro ao remover tarefa. ' . $e->getMessage();
}
