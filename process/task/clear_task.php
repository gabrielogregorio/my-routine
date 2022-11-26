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

    try {
        // Executa um update para o usuário logado
        $comando = $conexao->prepare("UPDATE tarefas SET marcada = 0 where id_usuario = ".$_SESSION["id"].';');
        $comando->execute();
        header('location: ../home.php'); 
    } catch (PDOException $e) {
        // Aconteceu algum erro
        $mensagem_erro = $e->getMessage();
        echo 'Erro ao executar a limpagem de tarefas'.$mensagem_erro;
    }
 
    $conexao = null;
