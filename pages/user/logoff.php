<?php

use MyRoutine\Support\Session;

require __DIR__ . '/../../vendor/autoload.php';

$session = new Session();
$session->destroy();

header('Location: ' . BASEURL);
