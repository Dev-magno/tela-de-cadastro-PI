<?php

//Conexão com o banco de dados
require_once "Classe/conexao.php";

//Classe usuário
require_once "Classe/user.php";
?>

<?php if(isset($_COOKIE['aviso'])) : ?>
    <section>
        <div class="alert">
            <?= $_COOKIE['aviso'] ?>
            <?php setcookie('aviso', '', time() - 10000, '/tela-de-cadastro-PI') ?>
        </div>
    </section>
<?php endif;?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD usuario</title>
    <link rel="stylesheet" href="style.css">
    <script src="JS/dom.js" defer></script>
</head>
<body>
    
    <main class="main-cadastro">
        <h2>Cadastrar Usuário</h2>
        <form action="insert.php" method="POST" onsubmit="return validarForm()">
            <div>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" required>
            </div>

            <div>
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" required>
            </div>

            <div>
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
            </div>

            <div>
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" required>
                <span class="span-cadastro"><i>somente números</i></span>
            </div>

            <div>
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" required></input>
                <span class="span-cadastro"><i>somente números</i></span>
            </div>

            <div>
                <label for="rg">RG</label>
                <input type="text" name="rg" id="rg" required></input>
                <span class="span-cadastro"><i>somente números</i></span>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required></input>
            </div>

            <div>
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required minlength="8" maxlength="15" aria-required="true">
                <img id="showPassword" class="show-password-button" src="./img/olho_fechado.png" alt="Campo para inserir a senha de cadastro do usuario">
                <span class="span-cadastro" id="message"></span>
            </div>

            <div>
                <label for="senha2">Confirmar Senha</label>
                <input type="password" name="senha" id="senha2" required minlength="8" maxlength="15" aria-required="true">
            </div>

            <input type="submit" value="Adicionar">
        </form>
    </main>
</body>
</html>
