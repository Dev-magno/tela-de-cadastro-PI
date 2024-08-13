<?php

//Conexão com o banco de dados
require_once "Classe/conexao.php";

// conexão com o banco de dados
require_once 'Classe/user.php';

$user = new User();

try {
    // Obtém os valores do formulário
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];
    $status = $_POST['status']; 

    // Adiciona uma validação para garantir que o perfil e status estejam corretos
    if ($userProfile !== 'administrador') {
        $perfil = 'normal';  // Define o perfil como 'normal' se não for administrador
        $status = 'ativo';   // Define o status como 'ativo' se não for administrador
    }

    // Define os valores no objeto User
    $user->setNome($nome);
    $user->setEndereco($endereco);
    $user->setDataNascimento($data_nascimento);
    $user->setTelefone($telefone);
    $user->setCpf($cpf);
    $user->setRg($rg);
    $user->setEmail($email);
    $user->setSenha($senha);
    $user->setPerfil($perfil);    // Define o perfil
    $user->setStatus($status);    // Define o status

    // Cria o usuário
    $user->criar();

    setcookie('aviso', 'Cadastro realizado com sucesso! Seja bem-vindo(a)!', time() + 3600, '/tela-de-cadastro-PI');
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}

?>

