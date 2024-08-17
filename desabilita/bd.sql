CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    email VARCHAR(100),
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);
---inserindo uma ussuario--

INSERT INTO usuarios (nome, email, status) 
VALUES ('João Silva', 'joao.silva@example.com', 'ativo');

INSERT INTO usuarios (nome, email, status) 
VALUES ('Marcone Silva', 'marcone.silva@example.com', 'ativo');