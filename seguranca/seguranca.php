<?php 

    if (function_exists("usuario_logado") == false) {
	    function usuario_logado(){

				// Usuário não está logado
		    if(isset($_SESSION["logado"]) == false)
		    {
		        session_unset(); // Iniciar Seção
		        session_destroy(); // Destruir seção
		        return false;
		    }
		    return true;
	   }
    }

		// Campo possui uma tentativa de sqlinjection
    if (function_exists("campo_e_valido") == false) {

			function campo_e_valido($variavel_teste, $nome_variavel){
	    		$valor_tratado = filter_input(INPUT_POST, "$variavel_teste", FILTER_SANITIZE_STRING);

			if (!$valor_tratado )
			{
	      	echo("Entrada inválida!" );
	      	return [false, ""];
			}

			return [true, $valor_tratado];
	    }
	}
