-- Criação do banco de dados books_db
CREATE DATABASE books_db


CREATE TABLE usuario_tb (
    usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL,
    endereco VARCHAR(160) NOT NULL,
    data_nascimento DATE NOT NULL UNIQUE,
    telefone VARCHAR(15) NOT NULL,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    rg VARCHAR(9) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL,
    perfil ENUM('normal', 'administrador') NOT NULL DEFAULT 'normal',
    status ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Criação da tabela Categoria_tb
CREATE TABLE categoria_tb (
categoria_id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(50) NOT NULL,
exige_isbn BOOLEAN NOT NULL
);

-- Criação da tabela Livro_tb
CREATE TABLE livro_tb (
livro_id INT PRIMARY KEY AUTO_INCREMENT,
titulo VARCHAR(150) NOT NULL,
categoria_id INT NOT NULL,
genero VARCHAR(50) NOT NULL,
descricao TEXT NOT NULL,
estado_conservacao VARCHAR(50) NOT NULL,
isbn VARCHAR(13),
imagem VARCHAR(255) NULL,
usuario_id INT NOT NULL,
FOREIGN KEY (categoria_id) REFERENCES Categoria_tb(categoria_id),
FOREIGN KEY (usuario_id) REFERENCES Usuario_tb(usuario_id)
);

-- Criação da tabela Troca_tb
CREATE TABLE troca_tb (
troca_id INT PRIMARY KEY AUTO_INCREMENT,
livro_oferecido_id INT NOT NULL,
livro_desejado_id INT NOT NULL,
status ENUM('Pendente', 'Aceita', 'Recusada') NOT NULL DEFAULT 'Pendente',
data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
data_aceitacao DATETIME,
data_conclusao DATETIME,
usuario_oferecente_id INT NOT NULL,
usuario_solicitante_id INT NOT NULL,
FOREIGN KEY (livro_oferecido_id) REFERENCES Livro_tb(livro_id),
FOREIGN KEY (livro_desejado_id) REFERENCES Livro_tb(livro_id),
FOREIGN KEY (usuario_oferecente_id) REFERENCES Usuario_tb(usuario_id),
FOREIGN KEY (usuario_solicitante_id) REFERENCES Usuario_tb(usuario_id)
);


Pefis fictcio

Perfil 1
Nome: Maria Oliveira
Endereço: Avenida Brasil, 456, Centro, Rio de Janeiro, RJ
Data de Nascimento: 22/07/1990
Telefone: 21998765432
CPF: 98765432100
RG: 123456789
Email: maria.oliveira@example.com
Senha: Mar!@Oliv1990

Perfil 2
Nome: Pedro Santos
Endereço: Rua das Acácias, 789, Bairro Primavera, Belo Horizonte, MG
Data de Nascimento: 30/11/1978
Telefone: 31912345678
CPF: 65432198700
RG: 987654321
Email: pedro.santos@example.com
Senha: P3dr0S@nt0s1978

Perfil 4
Nome: Lucas Ferreira
Endereço: Avenida Paulista, 1000, Bela Vista, São Paulo, SP
Data de Nascimento: 18/08/1988
Telefone: 11998765432
CPF: 78912345600
RG: 78912345600
Email: lucas.ferreira@example.com
Senha: Luc@sF3rr88

magno - lopes12@as
luana - Lu_12ar$00


            -- $conexao = Conexao::conectar();
            -- if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            --     $email = $_POST['email'];
            --     $senha = $_POST['senha'];
    
            --     // Buscar informações do usuário normal
            --     $stmt = $conexao->prepare('SELECT usuario_id, perfil, senha, status FROM usuario_tb WHERE email = ?');
            --     $stmt->execute([$email]);
            --     $resultado = $stmt->fetch(); // Aqui você define a variável $resultado
                     
            --     // Verifica se o usuário foi encontrado
            --     if ($resultado) {
            --         // Verifica se o status é 'ativo'
            --         if ($resultado['status'] === 'ativo') {
            --             // Se o status for ativo, considera o usuário como ativo
            --             return 'O usuário está ativo!';
            --         } else {
            --             // Se o status não for ativo, considera o usuário como inativo
            --             return 'O usuário está inativo';
            --         }
            --     }
    
            --     // Verificar se o login é para o administrador
            --     if ($email === 'admin@exemplo.com' && $senha === 'senha_admin') {
            --         $_SESSION['user_id'] = 1; // ID do administrador
            --         header('Location: dashboard_admin.php');
            --         exit();
            --     } else {
            --         // Verificar se a senha está correta
            --         if ($resultado && password_verify($senha, $resultado['senha'])) {
            --             $_SESSION['user_id'] = $resultado['usuario_id'];
            --             header('Location: dashboard_normal.php');
            --             exit();
                       
                       
            --         } else {
            --             echo 'Email ou senha incorretos!';
            --         }
            --     }
            -- }



-- // Verificar se o ID do usuário está presente na sessão
-- if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
--     echo "ID do usuário não fornecido ou inválido.";
--     exit;
-- }

-- $usuario_id = (int)$_GET['user_id']; 

-- try {
--     // Conectar ao banco de dados
--     $conexao = Conexao::conectar();

--     // Preparar a consulta para buscar as informações do usuário
--     $sql_user = "SELECT nome, email, data_nascimento, rg FROM usuario_tb WHERE usuario_id = :id";
--     $stmt_user = $conexao->prepare($sql_user);
--     $stmt_user->bindValue(':id', $usuario_id, PDO::PARAM_INT);

--     // Executar a consulta e verificar se houve erro
--     if (!$stmt_user->execute()) {
--         throw new Exception("Erro ao executar a consulta: " . implode(", ", $stmt_user->errorInfo()));
--     }

--     // Buscar os dados do usuário
--     $user = $stmt_user->fetch(PDO::FETCH_ASSOC);

--     // Verificar se o usuário foi encontrado
--     if ($user === false) {
--         echo "Usuário não encontrado.";
--         exit;
--     }

--     // Preparar a consulta para buscar os livros do usuário
--     $sql_livros = "SELECT nome FROM livro_tb WHERE usuario_id = :id";
--     $stmt_livros = $conexao->prepare($sql_livros);
--     $stmt_livros->bindValue(':id', $usuario_id, PDO::PARAM_INT);

--     // Executar a consulta de livros e verificar se houve erro
--     if (!$stmt_livros->execute()) {
--         throw new Exception("Erro ao executar a consulta de livros: " . implode(", ", $stmt_livros->errorInfo()));
--     }

--     // Buscar os dados dos livros
--     $livros = $stmt_livros->fetchAll(PDO::FETCH_ASSOC);

-- } catch (Exception $e) {
--     die($e->getMessage());
-- }

-- ?>

-- <!DOCTYPE html>
-- <html lang="pt-BR">
--  <head>
--     <meta charset="UTF-8">
--     <meta name="viewport" content="width=device-width, initial-scale=1.0">
--     <title>Usuário</title>
--     <link rel="stylesheet" href="style.css">
--  </head>
--  <body>
--     <main class="main-user">
--         <section class="user-itens">
--             <div>
--                <h1>Bem-vindo, <?= htmlspecialchars($user['nome']) ?></h1>
--             </div>
            
--             <div class="svg">
--                 <a href="#"><img src="./img/mensagem.svg" alt="Mensagem"></a>
--                 <a href="#"><img src="./img/add.svg" alt="Adicionar"></a>
--              </div>
--         </section>
        
--         <section class="user">
--             <aside>
--                 <p><strong>Nome:</strong><?= htmlspecialchars($user['nome']) ?></p>
--                 <p><strong>Email:</strong><?= htmlspecialchars($user['email']) ?></p>
--                 <p><strong>Data De Nascimento:</strong><?= htmlspecialchars($user['data_nascimento']) ?></p>
--                 <p><strong>RG:</strong><?= htmlspecialchars($user['rg']) ?></p>
--             </aside>

--             <section class="user-livros">
--                 <?php if (empty($livros)): ?>
--                     <p>Não há livros disponíveis para este usuário.</p>
--                 <?php else: ?>
--                      <?php foreach ($livros as $livro): ?>
--                         <div>
--                             <img src="<?= htmlspecialchars($livro['imagem']) ?>" alt="Livro"> 
--                         </div>
--                      <?php endforeach; ?>
--                  <?php endif; ?>
--              </section>
--         </section>
--      </main>
-- </body>
-- </html>