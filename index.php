<?php
    session_start(); // Remover variáveis de seção
    session_unset(); // Iniciar Seção
    session_destroy(); // Destruir seção

    include('login.php');
