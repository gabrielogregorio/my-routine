<?php

use MyRoutine\Support\Session;

require 'vendor/autoload.php';

$session = new Session();

if ($session->logged) {
    header('Location: ' . BASEURL . '/pages/home.php');
} else {
    header('Location: ' . BASEURL . '/pages/user/login.php');
}
