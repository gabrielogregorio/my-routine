<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APPNAME ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500&display=swap">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/css/app.main.css">
    <link rel="shortcut icon" href="<?= BASEURL ?>/public/favicon.ico" type="image/x-icon">
    <script src="<?= BASEURL ?>/public/js/app.main.js"></script>
    <script src="<?= BASEURL ?>/public/js/app.login.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= BASEURL ?>/pages/home.php">Minhas Rotinas</a></li>
                <li><a href="<?= BASEURL ?>/pages/user/conta.php">Conta</a></li>
                <li><a href="<?= BASEURL ?>/pages/user/logoff.php">Sair</a></li>
            </ul>
        </nav>
    </header>
