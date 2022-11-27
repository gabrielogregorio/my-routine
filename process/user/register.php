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
    $stmt->bind_param('ss', $username, $encryptedPassword);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    if (password_is_valid($password)) {
        $encryptedPassword = password_encryption($password);
        $stmt->execute();
        header('Location: ' . BASEURL);
    } else {
        echo 'Ops, sua senha dever ter pelo menos ' . PASSWORD_MIN_LEN . ' caracteres';
    }




    $mysql->close();
} catch (Exception $e) {
    header('Location: ' . BASEURL);
}
