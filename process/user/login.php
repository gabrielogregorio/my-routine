<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use MyRoutine\Database\MySqlManager;
use MyRoutine\Support\Session;

$session = new Session();

try {
    $manager = new MySqlManager();
    $mysql = $manager->connect();

    $query = 'SELECT `user_id`, `username`, `password` FROM `users` WHERE `username` = ?';

    $stmt = $mysql->prepare($query);
    $stmt->bind_param('s', $username);

    if (! empty(filter_input(INPUT_POST, 'username')) || ! empty(filter_input(INPUT_POST, 'password'))) {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }

    if ($result->num_rows) {
        $user = $result->fetch_object();

        if (password_checker($password, $user->password)) {
            $session->set('logged', true);
            $session->set('userID', $user->user_id);
            $session->set('username', $user->username);
        } else {
            echo 'Ops, usuário ou senha inválidos.';
        }

        $result->close();
        header('Location: ' . BASEURL . '/pages/home.php');
    } else {
        header('Location: ' . BASEURL);
    }
} catch (Exception $e) {
    $session->set('message', ['error' => ['login' => 'Erro ao entrar no sistema']]);
    header('Location: ' . BASEURL);
}
