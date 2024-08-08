<?php
//Inicia sessão
session_start();

//Conexão com o banco de dados
require_once "Classe/conexao.php";

//Classe usuário
require_once "Classe/user.php";

//Instancia da classe usuario
$user = new User();

//Acessa o método login da classe usuário
$user->login();
?>