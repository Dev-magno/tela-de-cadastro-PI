<?php
require_once 'Classe/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Valida o e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        exit;
    }

    try {
        // Conectar ao banco de dados
        $conexao = Conexao::conectar();

        // Verifica se o email existe no banco de dados
        $stmt = $conexao->prepare('SELECT * FROM Usuario_tb WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Gera um token único e define uma expiração (por exemplo, 1 hora)
            $token = bin2hex(random_bytes(50));
            $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Armazena o token e a expiração no banco de dados
            $stmt = $conexao->prepare('UPDATE Usuario_tb SET token_redefinicao = :token, token_expiracao = :expiracao WHERE email = :email');
            $stmt->execute(['token' => $token, 'expiracao' => $expiracao, 'email' => $email]);

            // Cria o link de redefinição de senha
            $link = "http://localhost/tela-de-cadastro-PI/redefinir_senha.php?token=" . $token;

            // Envia o email
            $to = $email;
            $subject = "Redefinição de Senha";
            $message = "Clique no link para redefinir sua senha: " . $link;
            $headers = "From: no-reply@seusite.com\r\n";
            $headers .= "Reply-To: no-reply@seusite.com\r\n";
            $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

            if (mail($to, $subject, $message, $headers)) {
                echo "Email de redefinição de senha enviado.";
            } else {
                echo "Falha ao enviar email.";
            }
        } else {
            echo "Email não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>


