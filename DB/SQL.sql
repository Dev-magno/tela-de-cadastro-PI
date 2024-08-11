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


           