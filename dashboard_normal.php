<?php
// Iniciar Sessão
session_start();

// Chama a classe BancoDados
require_once 'Classe/conexao.php'; 

// Chama a classe usuário
require_once 'Classe/user.php'; 

// Verificar se 'user-id' está presente na URL
if (isset($_GET['user-id'])) {
    // ID do usuário
    $usuario_id = $_GET['user-id']; 

    // Buscar informações do usuário
    $conexao = Conexao::conectar();
    $sql_user = "SELECT nome, email, data_nascimento, rg FROM usuario_tb WHERE usuario_id = :id";
    $stmt_user = $conexao->prepare($sql_user);
    $stmt_user->bindValue(':id', $usuario_id); 
    $stmt_user->execute();
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);

    // Buscar livros do usuário
    $sql_livros = "SELECT imagem FROM livro_tb WHERE usuario_id = :id"; // Correção aqui
    $stmt_livros = $conexao->prepare($sql_livros);
    $stmt_livros->bindValue(':id', $usuario_id); // Correção aqui
    $stmt_livros->execute();
    $livros = $stmt_livros->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "ID do usuário não fornecido.";
    exit; // Encerra o script se o ID não estiver presente
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="main-user">
        <section class="user-itens">
            <div>
                <h1>Bem-vindo<?= htmlspecialchars($user['nome']) ?></h1>
            </div>
            
            <div class="svg">
                <a href="#"><img src="./img/mensagem.svg" alt="Mensagem"></a>
                <a href="#"><img src="./img/add.svg" alt="Adicionar"></a>
            </div>
            
        </section>
        
        <section class="user">
            <aside>
                <p>Nome: <?= htmlspecialchars($user['nome']) ?></p>
                <p>Email: <?= htmlspecialchars($user['email']) ?></p>
                <p>Data De Nascimento: <?= htmlspecialchars($user['data_nascimento']) ?></p>
                <p>RG: <?= htmlspecialchars($user['rg']) ?></p>
            </aside>

            <section class="user-livros">
                <?php foreach ($livros as $livro): ?>
                <div>
                    <img src="<?= htmlspecialchars($livro['imagem']) ?>" alt="Livro"> 
                </div>
                <?php endforeach; ?>
                
            </section>
        </section>
    </main>
</body>
</html>

