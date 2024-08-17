<?php
require_once "Classe/user.php";

// Verifica se há uma solicitação POST para atualizar o status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['novo_status'])) {
        // Atualização de status
        $id = $_POST['id']; // Recebe o ID do usuário via POST
        $novo_status = $_POST['novo_status']; // Recebe o novo status via POST

        // Atualiza o status do usuário
        $conexao = Conexao::conectar();
        $sql = "UPDATE Usuario_tb SET status = :novo_status WHERE usuario_id = :id";
        $stmt = $conexao->prepare($sql);
        
        // Usa bindParam para vincular os parâmetros :novo_status e :id
        $stmt->bindValue(':novo_status', $novo_status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Atualiza a página para refletir as mudanças
            header('Location: listar.php');
            exit();
        } else {
            echo "Erro ao atualizar o status.";
        }
    }
}

$usuario = User::listar();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>

<div class="form-wrapper">
    <div class="controls">
        <a href="dashboard_admin.php" class="btn-back">Retornar</a>
    </div>
    <h1>Usuários Registrados</h1>
    <div class="table-container">
        <?php
        if ($usuario) {
            echo '<table class="table-users">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Nome</th>';
            echo '<th>Endereço</th>';
            echo '<th>Nascimento</th>';
            echo '<th>Telefone</th>';
            echo '<th>CPF</th>';
            echo '<th>RG</th>';
            echo '<th>Email</th>';
            echo '<th>Perfil</th>';
            echo '<th>Status</th>';
            echo '<th>Ação</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($usuario as $linha) {
                $nome = htmlspecialchars($linha['nome']);
                $email = htmlspecialchars($linha['email']);
                $status = htmlspecialchars($linha['status']);
                $id = htmlspecialchars($linha['usuario_id']);
                
                // Verifica se o status do usuário é inativo e exibe a mensagem em vermelho ao lado do nome
                $mensagem_inativo = ($status === 'inativo') ? " <span style='color: red;'>Seu usuário foi desabilitado por transgredir regras da comunidade!</span>" : "";

                // Define a ação do botão com base no status atual do usuário
                $acao = ($status === 'ativo') ? 'Desabilitar' : 'Habilitar';
                // Define o novo status com base na ação do botão
                $novo_status = ($status === 'ativo') ? 'inativo' : 'ativo';

                echo "<tr>";
                echo "<td>$nome$mensagem_inativo</td>";
                echo "<td>" . htmlspecialchars($linha['endereco']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['data_nascimento']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['telefone']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['cpf']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['rg']) . "</td>";
                echo "<td>$email</td>";
                echo "<td>" . htmlspecialchars($linha['perfil']) . "</td>";
                echo "<td>$status</td>";

                echo "<td class='options'>
                        <form action='listar.php' method='POST'>
                            <input type='hidden' name='id' value='$id' />
                            <input type='hidden' name='novo_status' value='$novo_status' />
                            <input type='submit' value='$acao' class='btn status-toggle " . ($status === 'ativo' ? 'disabled' : 'enabled') . "' />
                            <a href='editar.php?id=$id' class='btn edit'>Editar</a>
                            <a href='excluir.php?id=$id' class='btn delete' onclick='return confirm(\"Tem certeza que deseja remover este usuário?\")'>Deletar</a>
                        </form>
                      </td>";
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "<p>Nenhum usuário foi encontrado.</p>";
        }
        ?>
    </div>
</div>
    </div>
</body>

</html>