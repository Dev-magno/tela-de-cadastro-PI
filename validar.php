<?php
function verificarSenha($senha){
    // variaveis para verificar se false ou true
    $temMaiscula = false;
    $temMinuscula = false;
    $temDigito = false;
    $temOito = false;

    // Verifica o comprimento da senha
    if(strlen($senha) >= 8){
        $temOito = true;
    }
    
    // faz uma iteração no array e verificar cada caractere da senha
    foreach(str_split($senha) as $s){
         if(ctype_upper($s)){
            $temMaiscula = true;
        }
        elseif(ctype_lower($s)){
            $temMinuscula = true;
        }
        elseif(ctype_digit($s)){
            $temDigito = true;
        }
    }

      // verifica se a senha atende a todos os requisitos
        if($temMaiscula && $temMinuscula && $temDigito && $temOito){
            echo "Senha válida!<br>";
        }
        else{
            echo "Senha inválida!";
        }
}
verificarSenha("1Mnut674");
?>