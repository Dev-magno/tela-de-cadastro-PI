<?php
// Ativar a exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar a sessão
session_start();

// Incluir a classe de conexão com o banco de dados e a classe de usuário
require_once 'Classe/conexao.php'; 
require_once 'Classe/user.php'; 

// Verificar se o ID do usuário está presente na URL
if (!isset($_GET['user-id']) || !is_numeric($_GET['user-id'])) {
    echo "ID do usuário não fornecido ou inválido.";
    exit;
}

$usuario_id = (int)$_GET['user-id']; 

try {
    // Conectar ao banco de dados
    $conexao = Conexao::conectar();

    // Preparar a consulta para buscar as informações do usuário
    $sql_user = "SELECT nome, email, data_nascimento, rg FROM usuario_tb WHERE usuario_id = :id";
    $stmt_user = $conexao->prepare($sql_user);
    $stmt_user->bindValue(':id', $usuario_id);

    // Executar a consulta e verificar se houve erro
    if (!$stmt_user->execute()) {
        throw new Exception("Erro ao executar a consulta: " . implode(", ", $stmt_user->errorInfo()));
    }

    // Buscar os dados do usuário
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);

    // Verificar se o usuário foi encontrado
    if ($user === false) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Preparar a consulta para buscar os livros do usuário
    $sql_livros = "SELECT imagem FROM livro_tb WHERE usuario_id = :id";
    $stmt_livros = $conexao->prepare($sql_livros);
    $stmt_livros->bindValue(':id', $usuario_id);

    // Executar a consulta de livros e verificar se houve erro
    if (!$stmt_livros->execute()) {
        throw new Exception("Erro ao executar a consulta de livros: " . implode(", ", $stmt_livros->errorInfo()));
    }

    // Buscar os dados dos livros
    $livros = $stmt_livros->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    die($e->getMessage());
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
                <h1>Bem-vindo, <?= htmlspecialchars($user['nome']) ?></h1>
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
                <?php if (empty($livros)): ?>
                    <p>Não há livros disponíveis para este usuário.</p>
                <?php else: ?>
                    <?php foreach ($livros as $livro): ?>
                        <div>
                            <img src="<?= htmlspecialchars($livro['imagem']) ?>" alt="Livro"> 
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </section>
    </main>
</body>
</html>
