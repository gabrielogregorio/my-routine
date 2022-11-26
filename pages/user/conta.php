<?php

declare(strict_types=1);

use MyRoutine\Support\Session;

require __DIR__ . '/../../vendor/autoload.php';

$session = new Session();

if (! $session->logged) {
    header('Location: ' . BASEURL);
}

include __DIR__ . '/../../layout/header.php';
?>
<link rel="stylesheet" href="<?= BASEURL ?>/public/css/app.conta.css">
<style>
    ul > li:nth-child(2) > a:nth-child(1) {
        background-color: #E5E5E5;
        color: #78007A;
    }
</style>
<div class="container_conta">
    <h1 style="font-size: 1.4em; margin-bottom: 10px;">Gerenciar dados de acessos</h1>
    <form action="<?= BASEURL ?>/process/user/login.php" method="POST">
        <input type="email" name="email" value="<?php echo $session->username; ?>" placeholder="Email" autocomplete="on" required autofocus>
        <input type="password" name="password" placeholder="Digite a nova senha" autocomplete="on" required>
        <input type="password2" name="password" placeholder="Confirme a nova senha" autocomplete="on" required>
        <a href="#">Excluir conta por completo</a>
        <input type="submit" value="Salvar"></input>
    </form>
</div>
<?php include __DIR__ . '/../../layout/footer.php' ?>
