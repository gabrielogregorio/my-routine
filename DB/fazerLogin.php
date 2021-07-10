<?php

    session_start(); //iniciando um sessão
    sleep(0.5); // Evita respostas ultra rápidas
		
    include('../seguranca/seguranca.php');
    require_once("../conexao.php");
    include('criptografia.php');


    // Validar as entradas contra sqlinjection
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

    // Obter os valores
	$password = $teste_SenhaLogin[1];
	$email = $teste_EmailLogin[1];

	try {
		// Verificar se o usuário está cadastrado
		$comandoSQL = 'SELECT * FROM usuarios WHERE login = "'.$email.'"';
		$select = $conexao->query($comandoSQL);
	    $resultado = $select->fetchAll();

		if($resultado) {
            $hash = $resultado[0]['senha'];
            $bcrypt = new Criptografar();
            if ($bcrypt->validar_senha($password, $hash)) {
				// Usuário logado
				$_SESSION["logado"] = true;
				$_SESSION["id"] = $resultado[0]['id'];
				$_SESSION["login"] = $resultado[0]['login'];
				header('location: ../home.php');
			} else {
				// Usuário não está cadastrado
				$_SESSION["logado"] = false;	
				$mensagem_erro = "Senha ou e-mail incorreto, tente outra vez";
				header("location: ../index.php?mensagem_erro=$mensagem_erro");
			}
        } else {
            // Usuário não está cadastrado
            $_SESSION["logado"] = false;	
            $mensagem_erro = "O usuário ou senha não está registrado no sistema";
            header("location: ../index.php?mensagem_erro=$mensagem_erro");
        }

	} catch (PDOException $e) {
		// Erro no banco de dados
		$mensagem_erro = "Tem um problema aqui do meu lado, vou reportar a equipe, tente mais tarde. Foi mal!" + $e;
		header("location: ../index.php?mensagem_erro=$mensagem_erro");
	}

    // Destruir conexão
    $conexao = null;
