<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$host = $_SERVER['HOST'];
$user = $_SERVER['USER'];
$pass = $_SERVER['PASS'];
$db = $_SERVER['DB']; 

try 
{
    $conexao = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) 
{
    echo "Erro ao conectar com o banco de dados.\n\n".$e->getMessage();
}
