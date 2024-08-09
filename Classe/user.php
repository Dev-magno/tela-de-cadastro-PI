<?php
//Uso conexão aqui e não preciso usar em outros aquivos
require_once 'conexao.php';

Class User {
    private $usuario_id;
    private $nome;
    private $endereco;
    private $data_nascimento;
    private $telefone;
    private $cpf;
    private $rg;
    private $email;
    protected $senha;
    private $perfil;
    private $status;

    //Contrutor com o parmâmento $id inicializado em false.
    public function __construct($id = false) {
        //Verifica se há o recebimento de id. SE true troca o id atual pelo que está recendo
        if($id){
            $this->usuario_id = $id;//Se chamar um new user e não passar o id, não acontece nada. Se passar, o objeto é inicializado
            $this->carregar(); //Quando o id for passado ao mesmo que atribui um id para o objeto vai fazer um carregar. Usa o id para carregar o restante das informações
        }
    }

     // Settesr responsável por modificar o valor do nome
     public function setNome($nome) {
        return $this->nome = $nome;
    }

    public function setEndereco($endereco) {
        return $this->endereco = $endereco;
    }

    public function setDataNascimento($data_nascimento) {
        return $this->data_nascimento = $data_nascimento;
    }

    public function setTelefone($telefone) {
        return $this->telefone = $telefone;
    }

    public function setCpf($cpf) {
        return  $this->cpf = $cpf;
    }

    public function setRg($rg) {
        return $this->rg = $rg;
    }
    public function setEmail($email) {
        return  $this->email = $email;
    }

   // Utilizando hash para a senha
   public function setSenha($senha) {
    $this->senha = password_hash($senha, PASSWORD_DEFAULT);//cria um novo hash de senha usando um algoritmo forte de hash de mão única, especificando o algoritimo a ser usado bcrypt. 
    } 

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    // Getters para retornar o nome do objeto
    public function getUsuarioId() {
        return $this->usuario_id;
    }
   public function getNome() {
        return $this->nome;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getDataNascimento() {
        return $this->data_nascimento;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getRg() {
        return $this->rg;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function getStatus() {
        return $this->status;
    }

    //Método para criar usuário
    public  function criar() {
        try {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO usuario_tb (nome, endereco, data_nascimento, telefone, cpf, rg, email, senha, perfil, status) VALUES (:nome, :endereco, :data_nascimento, :telefone, :cpf, :rg, :email, :senha, :perfil, :status)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':nome', $this->getNome());
            $stmt->bindValue(':endereco', $this->getEndereco());
            $stmt->bindValue(':data_nascimento', $this->getDataNascimento());
            $stmt->bindValue(':telefone', $this->getTelefone());
            $stmt->bindValue(':cpf', $this->getCpf());
            $stmt->bindValue(':rg', $this->getRg());
            $stmt->bindValue(':email', $this->getEmail());
            $stmt->bindValue(':senha', $this->getSenha());
            $stmt->bindValue(':perfil', $this->getPerfil());
            $stmt->bindValue(':status', $this->getStatus());
            $stmt->execute();
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

     //Método carregar
     public function carregar() {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM usuario_tb WHERE usuario_id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->getUsuarioId());
        $stmt->execute();
        $resultado = $stmt->fetch();

        $this->setNome($resultado['nome']);
        $this->setEndereco($resultado['endereco']);
        $this->setDataNascimento($resultado['data_nascimento']);
        $this->setTelefone($resultado['telefone']);
        $this->setCpf($resultado['cpf']);
        $this->setRg($resultado['rg']);
        $this->setEmail($resultado['email']);
        $this->setSenha($resultado['senha']);
        $this->setSenha($resultado['perfil']);
        $this->setSenha($resultado['status']);
    }

    //Método para listar usuário
    public static function listar() {
        //Tratamento de erro
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM usuario_tb";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            $usuario = $stmt->fetchAll();
            return $usuario;
        } catch (PDOException $e) {
            echo "ERRO: ", $e->getMessage();
        }
    }

    //Método atualizar
    public function atualizar() {
        try {
            $conexao = Conexao::conectar();
            $sql = 'UPDATE usuario_tb SET nome=:nome, endereco=:endereco, data_nascimento=:data_nascimento, telefone=:telefone, cpf=:cpf, rg=:rg, email=:email, senha=:senha, perfil=:perfil, status=:status WHERE usuario_id = :usuario_id';
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':nome', $this->getNome());
            $stmt->bindValue(':endereco', $this->getEndereco());
            $stmt->bindValue(':data_nascimento', $this->getDataNascimento());
            $stmt->bindValue(':telefone', $this->getTelefone());
            $stmt->bindValue(':cpf', $this->getCpf());
            $stmt->bindValue(':rg', $this->getRg());
            $stmt->bindValue(':email', $this->getEmail());
            $stmt->bindValue(':senha', $this->getSenha());
            $stmt->bindValue(':perfil', $this->getPerfil());
            $stmt->bindValue(':status', $this->getStatus());
            $stmt->bindValue(':usuario_id', $this->getUsuarioId());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deletar($id) {
        try {
            //conexão com o banco
            $conexao = Conexao::conectar();
            $sql = "DELETE FROM usuario_tb WHERE usuario_id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $this->getUsuarioId());
            $stmt->execute();
        } catch (PDOException $e) {
            echo "ERRO: ", $e->getMessage();
        }
    }

    public function login() {
        try {
            $conexao = Conexao::conectar();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $senha = $_POST['senha'];
    
                // Buscar informações do usuário normal
                $stmt = $conexao->prepare('SELECT usuario_id, perfil, senha, status FROM usuario_tb WHERE email = ?');
                $stmt->execute([$email]);
                $resultado = $stmt->fetch(); // Aqui você define a variável $resultado
    
                // Verifica se o usuário foi encontrado
                if ($resultado) {
                    // Verifica se o status é 'ativo'
                    if ($resultado['status'] === 'ativo') {
                        // Se o status for ativo, considera o usuário como ativo
                        return 'O usuário está ativo!';
                    } else {
                        // Se o status não for ativo, considera o usuário como inativo
                        return 'O usuário está inativo';
                    }
                }
    
                // Verificar se o login é para o administrador
                if ($email === 'admin@exemplo.com' && $senha === 'senha_admin') {
                    $_SESSION['user_id'] = 1; // ID do administrador
                    header('Location: dashboard_admin.php');
                    exit();
                } else {
                    // Verificar se a senha está correta
                    if ($resultado && password_verify($senha, $resultado['senha'])) {
                        $_SESSION['user_id'] = $resultado['usuario_id'];
                        header('Location: dashboard_normal.php');
                        exit();
                    } else {
                        echo 'Email ou senha incorretos!';
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    

   // Método para alternar o status do usuário (ativo/inativo)
    public function toggleUsuarioStatus() {
        try {
            $conexao = Conexao::conectar();
            // Verifica se o user_id está definido no POST
            if (isset($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
                
                // Consulta SQL para obter o status atual do usuário
                $sql = "SELECT status FROM usuario_tb WHERE usuario_id = :id";
                $stmt = $conexao->prepare($sql); // Prepara a consulta
                
                if ($stmt) { // Verifica se a preparação da consulta foi bem-sucedida
                    $stmt->bindValue(':id', $user_id); // Atribui o valor do ID do usuário
                    $stmt->execute(); // Executa a consulta
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // Obtém o resultado como um array associativo
                    
                    // Verifica se o usuário foi encontrado no banco de dados
                    if ($resultado) {
                        // Determina o novo status com base no status atual
                        // Se o status atual é 'ativo', o novo será 'inativo', e vice-versa
                        $novo_status = ($resultado['status'] === 'ativo') ? 'inativo' : 'ativo';
                    
                        // Consulta SQL para atualizar o status do usuário
                        $sql_update = "UPDATE usuario_tb SET status = :status WHERE usuario_id = :id";
                        $stmt_update = $conexao->prepare($sql_update);
                        
                        if ($stmt_update) {
                            // Atribui o valor da variável $novo_status ao parâmetro :status na consulta SQL
                            $stmt_update->bindValue(':status', $novo_status);
                            // Atribui o valor da variável $user_id ao parâmetro :id na consulta SQL
                            $stmt_update->bindValue(':id', $user_id);
                            
                            // Executa a atualização e verifica se foi bem-sucedida
                            if ($stmt_update->execute()) {
                            // Exibe mensagem de sucesso com base no novo status
                            echo "Usuário " . ($novo_status === 'ativo' ? 'ativado' : 'desativado') . " com sucesso!";
                        } else {
                            echo "Erro ao atualizar o status do usuário.";
                        }
                    } else {
                        echo "Erro ao preparar a consulta de atualização.";
                    }
                } else {
                    echo "Usuário não encontrado.";
                }
            } 
        } 

        header('location: listar.php');
        exit();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}


     // Método para fazer logout
     public function logout() {
        session_start(); // Inicia a sessão
        session_destroy(); // Destroi a sessão
        header('Location: login.php'); // Redireciona para a página de login
        exit();
    }
}