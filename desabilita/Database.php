<?php
class Database {
    private $host = 'desabilita.mysql.dbaas.com.br'; // Endereço do servidor MySQL
    private $db_name = 'desabilita'; // Nome do banco de dados
    private $username = 'desabilita'; // Nome de usuário do banco de dados
    private $password = 'alunosDeV@24'; // Senha do banco de dados
    public $conn;

    // Método para conectar ao banco de dados
    public function getConnection() {
        $this->conn = null;

        try {
            // Cria uma nova instância de PDO para a conexão
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Define o modo de erro para exceções
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

// Cria uma nova instância da classe Database e obtém a conexão
$database = new Database();
$conn = $database->getConnection();
?>
