<?php
require_once 'Classe/conexao.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verifica se o token é válido e não expirou
    $conexao = Conexao::conectar();
    $stmt = $conexao->prepare('SELECT * FROM Usuario_tb WHERE token_redefinicao = :token AND token_expiracao > NOW()');
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Valida a nova senha
            $nova_senha = $_POST['nova_senha'];
            if (strlen($nova_senha) < 8) {
                echo "A nova senha deve ter pelo menos 8 caracteres.";
                exit;
            }

            $nova_senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);

            // Atualiza a senha e limpa o token
            $stmt = $conexao->prepare('UPDATE Usuario_tb SET senha = :senha, token_redefinicao = NULL, token_expiracao = NULL WHERE id = :id');
            $stmt->execute(['senha' => $nova_senha_hash, 'id' => $user['id']]);

            echo "Senha redefinida com sucesso!";
        }
    } else {
        echo "Token inválido ou expirado.";
    }
} else {
    echo "Token não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="card-detalhes">
        <div class="form-box">
            <div class="card-form">
                <h2>Redefinir Senha</h2>
                <form action="redefinir_senha.php?token=<?php echo htmlspecialchars($token); ?>" method="POST">
                    <div class="container">
                        <label for="nova_senha">Nova Senha:</label>
                        <input type="password" name="nova_senha" id="nova_senha" placeholder="Digite sua nova senha" required>
                    </div>
                    <div class="btn">
                        <button type="submit">Redefinir Senha</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>


