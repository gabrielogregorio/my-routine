<?php

use MyRoutine\Database\MySqlManager;
use MyRoutine\Support\Session;

require __DIR__ . '/../../vendor/autoload.php';

$session = new Session();

if (! $session->logged) {
    header('Location: '. BASEURL);
}

try {
    $manager = new MySqlManager();
    $mysql = $manager->connect();

    $query = 'UPDATE `tasks` SET `is_checked` = ? WHERE `task_id` = ? AND `user_id` = ?';

    $stmt = $mysql->prepare($query);
    $stmt->bind_param('iii', $isChecked, $taskID, $userID);

    $isChecked = (filter_input(INPUT_POST, 'checked') === 'true' ? 1 : '');
    $taskID = filter_input(INPUT_POST, 'taskID');
    $userID = $session->userID;

    $stmt->execute();

    if ($stmt->affected_rows) {
        $session->set('message', ['success' => ['task' => 'Tarefa marcada com sucesso!']]);
    }
} catch (Exception $e) {
    
}
