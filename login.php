<?php
//Iniciar Sessão
session_start();

require_once "Classe/conexao.php";
require_once "Classe/user.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="style.css">
<body>
    <section class="card-detalhes">
        <div class="form-detalhes">
            <h2>Seja Bem Vindo!</h2>
            <p>Troque, descubra e compartilhe livros com leitores apaixonados como você.</p>
        </div>
        <div class="form-box">
            <div class="card-form">
                <h2>Login</h2>
                <form action="verifica.php" method = "POST">
                    <div class="container">
                        <label for="email">Email:</label>
                        <input type="email" name="email" placeholder="Digite seu email" required arial-required="true" id="email">
                    </div>
        
                    <div class="container">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" placeholder="Digite sua senha" required arial-required="true" id="senha">

                    <div class="nav-login">
                        <a href="#" class="link">Recuperar senha?</a>  
                    </div> 
                    </div>
               
                    <div class="btn">
                        <button type="submit">Entrar</button>

                        <div>
                            <a href="index.php">Cadastrar</a>
                        </div> 
                    </div>                             
                    <div id="flash-message" class="flash-message">A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma letra minúscula e um dígito.</div>
                </form>
            </div>
        </div>

    </section>
</body>
</html>