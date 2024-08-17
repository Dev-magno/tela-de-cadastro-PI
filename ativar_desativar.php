<?php
require_once 'Classe/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId= $_POST['id'];
    
    $newStatus = $_POST['status'];
    
    // Instancie a classe Usuario e chame o método para atualizar o status Susuario new Usuario();
    $usuario->updateStatus($userId, $newStatus);
    
    // Retorne uma resposta de sucesso
    echo 'sucesso';
}
    
   