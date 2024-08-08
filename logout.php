<?php
//Iniciar Sessão
session_start();

//Conexão com o banco
require_once "Classe/conexao.php";

//Classe User
require_once "Classe/user.php";

// Instancia um novo usuario
$user = new User();

// Faz o logout e redireciona para a página de login
$user->logout(); 
?>
