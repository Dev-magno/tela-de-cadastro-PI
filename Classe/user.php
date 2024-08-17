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
        // Define o perfil somente se for válido
        if (in_array($perfil, ['normal', 'administrador'])) {
            $this->perfil = $perfil;
        } else {
            throw new Exception("Perfil inválido. Deve ser 'normal' ou 'administrador'.");
        }
    }

    public function setStatus($status) {
        // Verifica se o status é válido
        if (in_array($status, ['ativo', 'inativo'])) {
            $this->status = $status;
        } else {
            throw new Exception("Status inválido. Deve ser 'ativo' ou 'inativo'.");
        }
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
            $sql = "INSERT INTO Usuario_tb (nome, endereco, data_nascimento, telefone, cpf, rg, email, senha, perfil, status) VALUES (:nome, :endereco, :data_nascimento, :telefone, :cpf, :rg, :email, :senha, :perfil, :status)";
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
        $sql = "SELECT * FROM Usuario_tb WHERE usuario_id = :id";
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
    }

    //Método para listar usuário
    public static function listar() {
        //Tratamento de erro
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM Usuario_tb";
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
            $sql = 'UPDATE Usuario_tb SET nome=:nome, endereco=:endereco, data_nascimento=:data_nascimento, telefone=:telefone, cpf=:cpf, rg=:rg, email=:email, senha=:senha WHERE usuario_id = :usuario_id';
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':nome', $this->getNome());
            $stmt->bindValue(':endereco', $this->getEndereco());
            $stmt->bindValue(':data_nascimento', $this->getDataNascimento());
            $stmt->bindValue(':telefone', $this->getTelefone());
            $stmt->bindValue(':cpf', $this->getCpf());
            $stmt->bindValue(':rg', $this->getRg());
            $stmt->bindValue(':email', $this->getEmail());
            $stmt->bindValue(':senha', $this->getSenha());
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
            $sql = "DELETE FROM Usuario_tb WHERE usuario_id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $this->getUsuarioId());
            $stmt->execute();
        } catch (PDOException $e) {
            echo "ERRO: ", $e->getMessage();
        }
    }

    public function login() {
        try {
            // Processar o login
            $conexao = Conexao::conectar();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $senha = $_POST['senha'];
    
                if (!isset($_SESSION)) {
                    session_start();
                }
    
                // Busca informações do usuário
                $sql = 'SELECT usuario_id, perfil, senha, status FROM Usuario_tb WHERE email=?';
                $stmt = $conexao->prepare($sql);
                $stmt->execute([$email]);
                $user = $stmt->fetch();


                 // Verifique se o login é para o administrador
                 if ($email === 'admin@exemplo.com' && hash('sha256', $senha) === hash('sha256', 'senha_admin')) {
                    $_SESSION['user_id'] = 1; // ID do administrador
                    header('Location: dashboard_admin.php');
                    exit();
                }
                // Verifique se o usuário foi encontrado
                if ($user) {
                    //Verifica se o usuário está inativo
                    if($user['status'] === 'inativo') {
                        echo "Você está desabilitado. Entre em contato com o suporte.";
                        return;
                    }

                    // Verifique a senha usando password_verify
                    if (password_verify($senha, $user['senha'])) {
                        $_SESSION['user_id'] = $user['usuario_id'];
                            header('Location: dashboard_normal.php');
                            exit();
                        }else {
                        echo "Senha inválida! A senha deve conter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, dígitos e caracteres especiai";
                    }
                } 
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    
   // Método para alternar o status do usuário (ativo/inativo)
    public function updateStatus($id, $status) {
        try {
            $conexao = Conexao::conectar();
            $sql = 'UPDATE Usuario_tb SET status=:status WHERE usuario_id=:id';
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return true; //Atualização bem-sucedida
            }else {
                return false; //Nenhuma linha foi atualizada
            }

        header('location: listar.php');
        exit();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return false;
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