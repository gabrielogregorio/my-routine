<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use MyRoutine\Support\Session;
use MyRoutine\Database\MySqlManager;

$session = new Session();

try {
    $mysql = new MySqlManager();
    $conn = $mysql->connect();

    $query = 'INSERT INTO `users` (`username`, `password`) VALUES (?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    if ($stmt->execute()) {
        header('Location: ' . BASEURL);
    }
} catch (Exception $e) {
    $session->set('message', ['error' => ['register' => 'Erro ao realizar cadastro']]);
}
