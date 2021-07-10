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

    // Obtém via post o novo status e o id da tarefa
    $checked = filter_input(INPUT_POST, "checked",FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_POST, "id",FILTER_SANITIZE_STRING);
    $id_usuario = $_SESSION["id"];

    try {
        // Atualiza o status da tarefa que o usuário marcou para o novo status
        $comando = $conexao->prepare("UPDATE tarefas SET marcada = $checked where id = :id and id_usuario = :id_usuario");
        $comando->execute(array(
            ':id' => $id,
            ':id_usuario' => $id_usuario
        ));
    } catch (PDOException $e) {
        $mensagem_erro = $e->getMessage();
    }
    $conexao = null;
