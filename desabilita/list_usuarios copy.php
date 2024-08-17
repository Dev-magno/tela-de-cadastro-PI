<?php
include 'Database.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifica se há uma solicitação POST para atualizar o status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['novo_status'])) {
        // Atualização de status
        $id = $_POST['id']; // Recebe o ID do usuário via POST
        $novo_status = $_POST['novo_status']; // Recebe o novo status via POST

        // Atualiza o status do usuário
        $query = "UPDATE usuarios SET status = :novo_status WHERE id = :id";
        $stmt = $conn->prepare($query);
        
        // Usa bindParam para vincular os parâmetros :novo_status e :id
        $stmt->bindParam(':novo_status', $novo_status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Atualiza a página para refletir as mudanças
            header('Location: list_usuarios.php');
            exit();
        } else {
            echo "Erro ao atualizar o status.";
        }
    }
}

// Seleciona todos os usuários do banco de dados
$query = "SELECT * FROM usuarios";
$stmt = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Lista de Usuários</h1>
    
    <!-- Link para adicionar novos usuários -->
    <p><a href="adicionar_usuario.php">Adicionar Novo Usuário</a></p>
    
    <!-- Tabela de usuários -->
    <h2>Usuários Cadastrados</h2>
    <table border='1'>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>

        <?php
        // Usa o fetch com PDO::FETCH_ASSOC para obter um array associativo
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = htmlspecialchars($row['id']); // Escapa o ID do usuário para prevenir XSS
            $nome = htmlspecialchars($row['nome']); // Escapa o nome do usuário
            $email = htmlspecialchars($row['email']); // Escapa o e-mail do usuário
            $status = htmlspecialchars($row['status']); // Escapa o status do usuário
            // Define a ação do botão com base no status atual do usuário
            $acao = ($status === 'ativo') ? 'Desabilitar' : 'Habilitar';
            // Define o novo status com base na ação do botão
            $novo_status = ($status === 'ativo') ? 'inativo' : 'ativo';

            // Exibe uma linha da tabela para cada usuário
            echo "<tr>";
            echo "<td>$nome</td>"; // Exibe o nome do usuário
            echo "<td>$email</td>"; // Exibe o e-mail do usuário
            echo "<td>$status</td>"; // Exibe o status do usuário
            echo "<td>
                    <form action='list_usuarios.php' method='POST'>
                      <input type='hidden' name='id' value='$id' /> <!-- Campo oculto com o ID do usuário -->
                      <input type='hidden' name='novo_status' value='$novo_status' /> <!-- Campo oculto com o novo status -->
                      <input type='submit' value='$acao' /> <!-- Botão de envio com a ação apropriada -->
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>

    </table>
</body>
</html>
