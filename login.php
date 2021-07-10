<?php
    session_start(); // Remover variáveis de seção
    session_unset(); // Iniciar Seção
    session_destroy(); // Destruir seção

    include('layout/head.php');

    // Se vier um parametro get com o tipo cadastro, abra a opção cadastro
    if (isset($_GET["tipo"]) == true) {
      $tipo = $_GET["tipo"];
      if ($tipo == 'cadastro') {
        print_r("<script>toggleForm();</script>");
      }
    }
?>

  <style>
  ul > li > a {
    visibility:hidden;
  }
 </style>

  <link rel="stylesheet" href="style/style_login.css">

  <div class="container_login_cadastro">
    <div class="container_login">
      <form action="DB/fazerLogin.php" method="POST">

      <h4>Fazer Login</h4>
        <?php
            if (isset($_GET["mensagem_erro"]) == true) {
              $mensagem_erro = $_GET["mensagem_erro"];
              print_r("<span class=\"mensagem_erro\">$mensagem_erro</span>");
            }
        ?>
        <input type="email" name="email" placeholder="Email" autocomplete="on" required autofocus>
        <input type="password" name="password" placeholder="Senha" autocomplete="on" required>
        <input type="submit" value="Fazer Login"></input>
        <div class="alternativa">
          <span>Não tem conta? </span><a href="#" onclick="toggleForm();">Faça um Cadastro</a>
        </div><!-- alternativa -->
        <a href="#">Esqueci minha senha</a>
      </form><!-- form -->
    </div><!-- container_login -->

    <div class="container_cadastro">
      <form action="DB/fazerCadastro.php" method="POST">
        <h4>Fazer Cadastro</h4>
        <input type="email" name="email" placeholder="Email" autocomplete="on" required autofocus>
        <input type="password" name="password" placeholder="Senha" autocomplete="on" required>
        <input type="submit" value="Fazer cadastro"></input>
        <div class="alternativa">
          <span>Já tenho uma conta! </span><a href="#" onclick="toggleForm();">Faça login.</a>
        </div><!-- alternativa -->
        <a href="#">Esqueci minha senha</a>
      </form><!-- form -->
    </div><!-- container_cadastro -->
  </div><!-- container_login_cadastro -->

  <script>
    function toggleForm() {
      var container = document.querySelector('.container_login_cadastro');
      container.classList.toggle('cadastro_ativo');
    }
  </script>

<?php include('layout/footer.php');?>
