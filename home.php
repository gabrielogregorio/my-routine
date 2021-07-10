<?php
    include('seguranca/seguranca.php');

    session_start();
    if(usuario_logado() == false) {
        header("location: index.php");
        exit;
    }
    include('layout/head.php');
 ?>

 
  <style>
  ul > li:nth-child(1) > a:nth-child(1) {
    background-color: #E5E5E5;
    color: #78007A;
  }
 </style>

  <div class="box">
    <h1>Minha Rotina</h1>
    <div class="items_flex">

    <?php 
        require_once('conexao.php');
        $comandoSQL = "SELECT * FROM tarefas where id_usuario = ".$_SESSION["id"].';';
        $select = $conexao->query($comandoSQL);
        $resultado = $select->fetchAll();

        foreach ($resultado as $linha) {
          if ($linha['marcada'] == 1) {
            $linha['marcada'] = 'checked';
          } else {
            $linha['marcada'] = '';
          }
    ?>
      <div class="item <?php echo $linha['marcada']?>">
        <form action="DB/removerTarefa.php" method="POST" class="item_remover">
          <input type="hidden" name="id" value="<?php echo $linha['id']?>">
          <input type="submit" value="X">
        </form><!-- excluir item -->

        <form class="checkboxLabel" action="/select" method="POST">
          <input type="hidden" value="id">
          <label id="span<?php echo $linha['id']?>" class="<?php echo $linha['marcada']?> label_item"><?php echo $linha['nome']?></label>
          <input type="checkbox" <?php echo $linha['marcada']?> name="checked" id="chec<?php echo $linha['id']?>" onclick="validar_checked('<?php echo $linha['id']?>')">
        </form><!-- checkbox-->
      </div><!-- item -->

    <?php } ?>
    </div><!-- items_flex -->

    <div class="tarefa_e_novo_dia">
      <form action="DB/novaTarefa.php" method="POST" class="nova_tarefa">
        <input name="texto" type="text" placeholder="Nova tarefa">
        <input type="submit" value="+">
        <input type="submit" value="Adicionar tarefa" id="add_tarefa_mobile">
      </form>

      <div class="novo_dia"> 
        <form class="button" action="DB/limparTarefas.php" method="POST">
          <input type="submit" value="Começar um novo dia">
        </form>        
      </div>
    </div><!-- tarefa_e_novo_dia -->
  </div><!-- box-->

<?php include('layout/footer.php');?>