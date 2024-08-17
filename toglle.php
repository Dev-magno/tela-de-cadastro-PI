<?php

require_once 'Classe/conexao.php'; // Certifique-se de incluir o arquivo correto para conexão com o banco de dados

require 'Classe/user.php';

if (isset($_POST['user_id'])) {
    $userId = intval($_POST['user_id']);
    
    // Instancia a classe e chama o método
    $usuario = new Usuario(); // Instancie a classe correspondente
    $conexao = Conexao::conectar();

    // Consulta o status atual do usuário
    $query = "SELECT status FROM Usuario_tb WHERE usuario_id = :id";
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id', $userId);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $novo_status = ($resultado['status'] === 'ativo') ? 'inativo' : 'ativo';

        // Chama o método para atualizar o status
        if ($usuario->updateStatus($userId, $novo_status)) {
            // Retorna o novo status para o JavaScript
            echo $novo_status;
        } else {
            echo "Erro ao atualizar o status.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}

