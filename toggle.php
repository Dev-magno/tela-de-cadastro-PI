<?php
//Iniciar Sessão
session_start();

//Conexão com o banco de dados
require_once "Classe/conexao.php";

//Classe usuário
require_once "Classe/user.php";

$user = new User();
$user->toggleUsuarioStatus();

?>