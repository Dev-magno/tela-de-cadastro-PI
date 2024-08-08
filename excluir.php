<?php
// Inicia a sessão
session_start(); 

require_once "Classe/conexao.php"; //Conexão com  banco
require_once "Classe/user.php"; //Chama a classe User

$id = $_GET['id'];

$user = new User($id); //Instancia um novo usuario e chamando o construtor

$user->deletar($id);//Acessa o método deletar

header('location: listar.php');
exit();
?>