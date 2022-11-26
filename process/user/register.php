<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use MyRoutine\Support\Session;
use MyRoutine\Database\MySqlManager;

$session = new Session();

try {
    $manager = new MySqlManager();
    $mysql = $manager->connect();

    $query = 'INSERT INTO `users` (`username`, `password`) VALUES (?, ?)';
    $stmt = $mysql->prepare($query);
    $stmt->bind_param('ss', $username, $password);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $stmt->execute();
    header('Location: ' . BASEURL);

    $mysql->close();
} catch (Exception $e) {
    header('Location: ' . BASEURL);
}
