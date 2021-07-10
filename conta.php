<?php
    include('seguranca/seguranca.php');
    
    session_start();
    if(usuario_logado() == false) {
        header("location: index.php");
        exit;
    }
    include('layout/head.php');

    $login = $_SESSION['login'];
 ?>

<style>
  ul > li:nth-child(2) > a:nth-child(1) {
    background-color: #E5E5E5;
    color: #78007A;
  }
 </style>

  <link rel="stylesheet" href="style/style_conta.css">

  <div class="container_conta">
    <h4>Gerenciar dados de acessos</h4>

    <form action="DB/fazerLogin.php" method="POST">
      <input type="email" name="email" value="<?php echo $login; ?>" placeholder="Email" autocomplete="on" required autofocus>
      <input type="password" name="password" placeholder="Digite a nova senha" autocomplete="on" required>
      <input type="password2" name="password" placeholder="Confirme a nova senha" autocomplete="on" required>

      <a href="#">Excluir conta por completo</a>
      <input type="submit" value="Salvar"></input>
    </form>

  </div>

<?php include('layout/footer.php');?>