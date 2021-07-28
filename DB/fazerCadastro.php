<?php
   
session_start(); //inicia um sessão
$_SESSION["logado"] = false; // Não está logado ~ permitido

include('../seguranca/seguranca.php');
require_once("../conexao.php");
include('criptografia.php');


// Testa as entradas para ver se possuem tentativas de sqlinjection
$teste_SenhaLogin = campo_e_valido("password", "Senha");
$teste_EmailLogin = campo_e_valido("email", "Email");

// Se houver algum parametro inválido ou faltante, retorne para a tela inicial;
if ($teste_SenhaLogin[0] == false) {
	header("location: ../index.php");
	exit;
}

if ($teste_EmailLogin[0] == false) {
	header("location: ../index.php");
	exit;
}

// Entradas validadas, obter o valor especifico
$password = $teste_SenhaLogin[1];
$email = $teste_EmailLogin[1];

// Criptografia com o bycrypt
$bcrypt = new Criptografar;
$hash = $bcrypt->encriptar($password);

// Tenta cadastrar o usuário
try {
	$comando =  $conexao->prepare('insert into usuarios (login, senha) values (:login, :senha)');
	$comando->execute(array(
		':login' => $email,
		':senha'=> $hash
	));

	// Se o usuário foi cadastrado
	if($comando->rowCount() > 0)
	{
		// Coletar o ID do novo usuário
		$comandoSQL = 'SELECT * FROM usuarios WHERE login = "'.$email.'" AND senha = "'.$hash.'"';
		$select = $conexao->query($comandoSQL);
		$resultado = $select->fetchAll();
		
		// id obtido
		if($resultado) {
    		// Salva o id, login e um indicador que o usuário está logado no sistema
			$_SESSION["logado"] = true;
			$_SESSION["id"] = $resultado[0]['id'];
			$_SESSION["login"] = $resultado[0]['login'];
			header("location: ../home.php");
		} else {
			// Id não obtido, usuário não conseguiu se cadastrar
			$_SESSION["logado"] = false;
			// Retornar a mensagem de erro ao usuário
			$tipo = "cadastro";
			header("location: ../index.php?tipo=$tipo");
		}

	} else {
		// Usuário não foi cadastrado no sistema por algum erro
		echo "Ops, Erro ao gravar os dados";
	}

	} catch (PDOException $e) {

		$tipo = "cadastro";

		// Violação de chave unica
		if($e->errorInfo[1] == 1062) {
			$mensagem_erro = 'Já existe um usuário com esse e-mail, por favor, tente outro e-mail';
			header("location: ../index.php?tipo=$tipo&mensagem_erro=$mensagem_erro");	
		} else {
			$mensagem_erro = 'Ops, houve um erro desconhecido! Desculpe pelo incoveniente!';
			header("location: ../index.php?tipo=$tipo&mensagem_erro=$mensagem_erro");	
		}
	}
// Destruir a conexão
$conexao = null;
