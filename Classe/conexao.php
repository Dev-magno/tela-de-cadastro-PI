<?php

class Conexao{

    private $host = 'localhost';
    private $db = 'books_db';
    private $user = 'root';
    private $pass = '';

    //método construtor para conexão
    public static function conectar() {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=books_db;charset=utf8", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());// termina a execução do script (die()) e exibe uma mensagem personalizada e retora a mensagem de erro da exceção ($e->getMessage()). 
        }
           
    }
    
}

