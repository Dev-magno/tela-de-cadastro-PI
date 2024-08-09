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
    <div class="form-container">
        <div class="table-controls">
            <a href="dashboard_admin.php" class="back-button">Voltar</a>
        </div>
        <h1>Listar Usuários</h1>
        <div class="table-wrapper">
            <?php
            // Verifica se a consulta retornou resultados
            if ($usuario) {
                echo '<table class="user-table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Nome</th>';
                echo '<th>Endereço</th>';
                echo '<th>Data de Nascimento</th>';
                echo '<th>Telefone</th>';
                echo '<th>CPF</th>';
                echo '<th>RG</th>';
                echo '<th>Email</th>';
                echo '<th>Perfil</th>';
                echo '<th>Status</th>';
                echo '<th>Ações</th>';
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
                    echo '<td>' . htmlspecialchars($linha['rg']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['perfil']) . '</td>';
                    echo '<td>' . htmlspecialchars($linha['status']) . '</td>';
                    echo '<td class="actions">';
                    echo '<a id="editar" href="editar.php?id=' . htmlspecialchars($linha['usuario_id']) . '" class="button edit">Editar</a>';
                    echo '<a id="excluir" href="excluir.php?id=' . htmlspecialchars($linha['usuario_id']) . '" class="button delete" onclick="return confirm(\'Tem certeza que deseja deletar este usuário?\')">Deletar</a>';
                    //A função confirm() retorna true se o usuário clicar em "OK" e false se o usuário clicar em "Cancel".
                    echo '<a id="toggle" href="toggle.php?id=' . htmlspecialchars($linha['usuario_id']) . '" class="button toggle">' . ($linha['status'] == 'ativo' ? 'Desativar' : 'Ativar') . '</a>';
                    // retornar um valor com base em uma condição. Determina o texto e a classe do botão de ativar/desativar
                    // Se verdadeiro: 'Desativar' (para $toggleText) e 'button toggle deactivate' (para $toggleClass)
                    // Se falso: 'Ativar' (para $toggleText) e 'button toggle activate' (para $toggleClass)
                    echo '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "Nenhum resultado encontrado.";
            }
            ?>
        </div>
    </div>
</body>
</html>
