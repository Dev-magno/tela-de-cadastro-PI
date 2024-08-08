<?php
//Conexão com o banco de dados
require_once "Classe/conexao.php";

// conexão com o banco de dados
require_once 'Classe/user.php';

$user = new User();

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
    $user->criar();

    header("Location: index.php");
    exit();
?>

