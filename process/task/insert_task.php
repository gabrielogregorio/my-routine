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
	  $texto = filter_input(INPUT_POST, "texto",FILTER_SANITIZE_STRING);
		$id_usuario = $_SESSION["id"];

   try {
		 // Executa um insert da nova tarefa no usuário
	   $comando = $conexao->prepare("INSERT INTO tarefas (nome, id_usuario) 
																	 VALUES (:texto, :id_usuario)");

		$comando->execute(array(
			':texto' => $texto,
			'id_usuario' => $id_usuario
		));

		// Se foi inserido com sucesso
		if($comando->rowCount() > 0)
		{ header('location: ../home.php'); }
		else
		{ echo "Ops, Erro ao gravar os dados"; }

	} catch (PDOException $e) {
		// Erro na execução do comando
		echo("Erro ao gravar a informação. \n\n".$e->getMessage());
	}

	$conexao = null;
