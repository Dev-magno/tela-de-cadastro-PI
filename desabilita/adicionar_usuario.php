<?php
include 'Database.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifica se há uma solicitação POST para adicionar um novo usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome']) && isset($_POST['email'])) {
    $nome = $_POST['nome']; // Recebe o nome do usuário via POST
    $email = $_POST['email']; // Recebe o e-mail do usuário via POST

    // Prepara a consulta SQL para inserir um novo usuário
    $query = "INSERT INTO usuarios (nome, email, status) VALUES (:nome, :email, 'ativo')";
    $stmt = $conn->prepare($query);
    
    // Usa bindParam para vincular os parâmetros :nome e :email
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // Redireciona para a página de listagem após a inserção
        header('Location: list_usuarios.php');
        exit();
    } else {
        echo "Erro ao inserir o usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Usuário</title>
</head>
<body>
    <h1>Adicionar Novo Usuário</h1>
    
    <!-- Formulário para inserção de novos usuários -->
    <form action="adicionar_usuario.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="Adicionar Usuário">
    </form>
    
    <!-- Botão para voltar à lista de usuários -->
    <form action="list_usuarios.php" method="get">
        <input type="submit" value="Voltar à Lista de Usuários">
    </form>
</body>
</html>

