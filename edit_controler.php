<?php
// Inicia a sessão
session_start(); 

//Conexão com o banco
require_once "Classe/conexao.php";

//Classe User
require_once "Classe/user.php";

$id = $_POST['id']; // recebe id via post

$id = $_POST['usuario_id']; 
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg']; 
$email = $_POST['email']; 
$senha = $_POST['senha'];
$senha = $_POST['perfil'];
$senha = $_POST['status'];

$user = new User($id); //Cria um nome objeto usuario

//Chama todos os dados (seters) para modificar pelos dados que o usuário coloca no campo do formulário
$user->setNome($nome);
$user->setEndereco($endereco);
$user->setDataNascimento($data_nascimento);
$user->setTelefone($telefone);
$user->setCpf($cpf);
$user->setRg($rg);
$user->setEmail($email);
$user->setSenha($senha);
$user->setSenha($perfil);
$user->setSenha($status);

$user->atualizar();

// redireciona para a página index.php após inserção bem-sucedida
header("Location: listar.php");
exit();
?>

