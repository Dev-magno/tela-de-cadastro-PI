<?php
//Iniciar Sessão
session_start();

require_once "Classe/conexao.php";
require_once "Classe/user.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="JS/dom.js" defer></script>
<body>
    <section class="card-detalhes">
        <div class="form-detalhes">
            <h2>Seja Bem Vindo!</h2>
            <p>Troque, descubra e compartilhe livros com leitores apaixonados como você.</p>
        </div>
        <div class="form-box">
            <div class="card-form">
                <h2>Login</h2>
                <form action="verifica.php" method = "POST" onsubmit="return validarForm()">
                    <div class="container">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Digite seu email" arial-required="true">
                    </div>
        
                    <div class="container">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" arial-required="true">
                        <img id="showPassword" class="show-password-button-login" src="./img/olho_fechado.png" alt="Campo para inserir a senha do usuario">
                        

                    <div class="nav-login">
                        <a href="#" class="link">Recuperar senha?</a>  
                    </div> 
                    </div>
               
                    <div class="btn">
                        <button type="submit">Entrar</button>
                    </div>                             
                    <!-- <div id="flash-message" class="flash-message">A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma letra minúscula e um dígito.</div> -->
                </form>
                <div class="link-cadastro">
                    <a href="index.php">Cadastrar</a>
                </div> 
            </div>
        </div>

    </section>
</body>
</html>