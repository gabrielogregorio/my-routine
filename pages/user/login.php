<?php

use MyRoutine\Support\Session;

require __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../../layout/header.php';

$session = new Session();

?>
<link rel="stylesheet" href="<?= BASEURL ?>/public/css/app.login.css">
<style>
    ul > li > a {
        visibility: hidden;
    }
</style>
<div class="container_login_cadastro">
    <!-- Login Form -->
    <div class="container_login">
        <form action="<?= BASEURL ?>/process/user/login.php" method="POST">
            <h1 style="font-size: 1.8em;">Sign In</h1>
            <input type="email" name="username" placeholder="Email" autocomplete="on" autofocus aria-required="true">
            <input type="password" name="password" placeholder="Senha" autocomplete="on">
            <input type="submit" value="Fazer Login"></input>
            <div class="alternativa">
                <span>Não tem conta? </span><a href="#" onclick="toggleForm();">Faça um Cadastro</a>
            </div>
            <a href="#">Esqueci minha senha</a>
        </form>
    </div>
    <!-- Registration Form -->
    <div class="container_cadastro">
        <form action="<?= BASEURL ?>/process/user/register.php" method="POST">
            <h1 style="font-size: 1.8em;">Register</h1>
            <input type="email" name="username" placeholder="Email" autocomplete="on" autofocus aria-required="true">
            <input type="password" name="password" placeholder="Senha" autocomplete="on">
            <input type="submit" value="Fazer cadastro"></input>
            <div class="alternativa">
                <span>Já tenho uma conta! </span><a href="#" onclick="toggleForm();">Faça login.</a>
            </div>
            <a href="#">Esqueci minha senha</a>
        </form>
    </div>
</div>
<?php
  // Se vier um parametro get com o tipo cadastro, abra a opção cadastro
if (isset($_GET["tipo"]) == true):
    $tipo = $_GET["tipo"];
    if ($tipo == 'cadastro'):
        //print_r("<script>toggleForm();</script>");
    endif;
endif;

include __DIR__ . '/../../layout/footer.php';

?>
