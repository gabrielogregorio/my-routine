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

    $query = 'INSERT INTO `tasks` (`task_name`, `user_id`, `is_checked`) VALUES (?, ?, ?)';

    $stmt = $mysql->prepare($query);
    $stmt->bind_param('sis', $taskName, $userID, $isChecked);

    $taskName = filter_input(INPUT_POST, 'newTask');
    $userID = $session->userID;
    $isChecked = 0;

    $stmt->execute();

    if ($stmt->affected_rows) {
        header('Location: ' . BASEURL);
    } else {
        echo 'Ops, erro ao inserir nova tarefa';
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo $e->getMessage();
}
