<?php
//Iniciar Sessão
session_start();

//Conexão com o banco
require_once "Classe/conexao.php";

//Classe User
require_once "Classe/user.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="dashboard-admin">
        <header class="div-admin">
            <h1>Painel Administrativo</h1>
        </header>

        <div class="welcome-message">
            <p>Bem-vindo, Administrador!</p>
        </div>
        <div class="panel-board">
            <div class="panel">
                <h2>Listar Usuários</h2>
                <a href="listar.php">Ir para a lista de usuários</a>
            </div>
        </div>
           
        </section>
        
    </div>
</body>
</html>

               
