<?php 
    include('../seguranca/seguranca.php');
    // Inicia a seção e verifica se o usuário está logado
    session_start(); //iniciando um sessão
    if(usuario_logado() == false) {
        header("location: ../index.php");
        exit;
    }

    // Obtem a conexão
    require_once("../conexao.php");

		// Obtém via post o texto da nova tarefa e o id do usuário
	  $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
		$id_usuario = $_SESSION["id"];

   try {
	   $comando = $conexao->prepare("delete from tarefas where id = :id and id_usuario = :id_usuario");

		$comando->execute(array(
			':id' => (int) $id,
			'id_usuario' => (int) $id_usuario
		));

		if($comando->rowCount() > 0)
		{
			header('location: ../home.php');
		}
		else
		{
			echo "Ops, Erro ao gravar os dados";
		}

	} catch (PDOException $e) {
		echo("Erro ao gravar a informação. \n\n".$e->getMessage());
	}

	$conexao = null;
