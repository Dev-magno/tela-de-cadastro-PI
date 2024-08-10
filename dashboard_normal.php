<?php

// Incluir a classe de conexão com o banco de dados
require_once 'Classe/conexao.php'; 

// Iniciar a sessão
session_start();

// Verifique se o ID do usuário está presente na sessão
if (isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id'])) {
    $usuario_id = (int)$_SESSION['user_id'];

    try {
        // Conectar ao banco de dados
        $conexao = Conexao::conectar();

        // Preparar a consulta para buscar as informações do usuário
        $sql_user = "SELECT nome, email, data_nascimento, rg FROM usuario_tb WHERE usuario_id = :id";
        $stmt_user = $conexao->prepare($sql_user);
        $stmt_user->bindValue(':id', $usuario_id, PDO::PARAM_INT);
        $stmt_user->execute();
        $user = $stmt_user->fetch(PDO::FETCH_ASSOC);

        // Verificar se o usuário foi encontrado
        if ($user === false) {
            throw new Exception("Usuário não encontrado.");
        }

        // Preparar a consulta para buscar os livros do usuário
        $sql_livros = "SELECT titulo FROM livro_tb WHERE usuario_id = :id";
        $stmt_livros = $conexao->prepare($sql_livros);
        $stmt_livros->bindValue(':id', $usuario_id, PDO::PARAM_INT);
        $stmt_livros->execute();
        $livros = $stmt_livros->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        die("Erro: " . $e->getMessage());
    }
} else {
    echo "ID do usuário não fornecido ou inválido.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
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
               <h1>Bem-vindo(a), <?= htmlspecialchars($user['nome']) ?></h1>
            </div>
            
            <div class="svg">
                <a href="#"><img src="./img/mensagem.svg" alt="Mensagem"></a>
                <a href="#"><img src="./img/add.svg" alt="Adicionar"></a>
             </div>
        </section>
        
        <section class="user">
            <aside>
                <p><strong>Nome:</strong> <?= htmlspecialchars($user['nome']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Data De Nascimento:</strong> <?= htmlspecialchars($user['data_nascimento']) ?></p>
                <p><strong>RG:</strong> <?= htmlspecialchars($user['rg']) ?></p>
            </aside>

            <section class="user-livros">
                <?php if (empty($livros)): ?>
                    <p>Não há livros disponíveis para este usuário.</p>
                <?php else: ?>
                     <?php foreach ($livros as $livro): ?>
                        <div>
                            <p><?= htmlspecialchars($livro['titulo']) ?></p>
                        </div>
                     <?php endforeach; ?>
                 <?php endif; ?>
             </section>
        </section>
     </main>
</body>
</html>
