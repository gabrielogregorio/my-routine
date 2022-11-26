<?php

require __DIR__ . '/../../vendor/autoload.php';

use MyRoutine\Database\MySqlManager;
use MyRoutine\Support\Session;

$session = new Session();

try {
    $manager = new MySqlManager();
    $mysql = $manager->connect();

    $query = 'SELECT `user_id`, `username`, `password` FROM `users` WHERE `username` = ? AND `password` = ?';

    $stmt = $mysql->prepare($query);
    $stmt->bind_param('ss', $username, $password);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }

    if ($result->num_rows) {
        $user = $result->fetch_object();

        $session->set('logged', true);
        $session->set('userID', $user->user_id);
        $session->set('username', $user->username);

        $result->close();

        header('Location: ' . BASEURL . '/pages/home.php');
    } else {
        $session->set('message', 'Ops, usuário ou senha inválidos');
        header('Location: ' . BASEURL);
    }
} catch (Exception $e) {
    $session->set('message', ['error' => ['login' => 'Erro ao entrar no sistema']]);
    header('Location: ' . BASEURL);
}
