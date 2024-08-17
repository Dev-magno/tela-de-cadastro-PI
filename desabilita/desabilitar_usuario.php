<?php
include 'Database.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Recebe o ID do usuário via POST
    $novo_status = $_POST['novo_status']; // Recebe o novo status via POST

    // Atualiza o status do usuário
    $query = "UPDATE usuarios SET status = :novo_status WHERE id = :id";
    $stmt = $conn->prepare($query);
    
    // Usa bindParam para vincular os parâmetros :novo_status e :id
    $stmt->bindParam(':novo_status', $novo_status, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Status do usuário atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o status do usuário.";
    }

    $stmt->closeCursor(); // Fecha o cursor da consulta
    $conn = null; // Fecha a conexão com o banco de dados
}

echo "<br><a href='list_usuarios.php'>Voltar à lista de usuários</a>";
?>
