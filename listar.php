<?php
require_once "Classe/user.php";

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

<body>
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
                echo '<th>Nome Completo</th>';
                echo '<th>Localização</th>';
                echo '<th>Nascimento</th>';
                echo '<th>Contato</th>';
                echo '<th>Documento</th>';
                echo '<th>Correio Eletrônico</th>';
                echo '<th>Papel</th>';
                echo '<th>Situação</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($usuario as $linha) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($linha['nome']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['endereco']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['data_nascimento']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['telefone']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['cpf']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['perfil']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['status']) . '</td>';
                    echo '<td class="options">';
                    echo '<a href="editar.php?id=' . htmlspecialchars($linha['usuario_id']) . '" class="btn edit">Editar</a>';
                    echo '<a href="excluir.php?id=' . htmlspecialchars($linha['usuario_id']) . '" class="btn delete" onclick="return confirm(\'Tem certeza que deseja remover este usuário?\')">Deletar</a>';
                    echo '<a href="toggle.php?id=' . htmlspecialchars($linha['usuario_id']) . '" class="btn status-toggle ' . ($linha['status'] == 'ativo' ? 'enabled' : 'disabled') . '">' . ($linha['status'] == 'ativo' ? 'Desabilitar' : 'Habilitar') . '</a>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo "<p>Nenhum usuário foi encontrado.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>