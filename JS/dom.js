   // Função para mostrar/ocultar a senha
   const showPassword = document.querySelector('#showPassword');
   const senha = document.querySelector('#senha');
   const senha2 = document.querySelector('#senha2');
   let mostrar = false; // Variável de controle para alternar entre mostrar e ocultar a senha

    // Adiciona um evento de clique ao botão de mostrar/ocultar senha
   showPassword.addEventListener('click', () => {
       if (mostrar) { // Se a senha estiver visível
           senha.type = 'password';
           senha2.type = 'password';
           showPassword.src = './img/olho_fechado.png';
           mostrar = false; // Atualiza o estado para "não mostrar"
       } else { // Se a senha estiver oculta
           senha.type = 'text';
           senha2.type = 'text';
           showPassword.src = './img/olho_aberto.png';
           mostrar = true; // Atualiza o estado para "mostrar"
       }
   });

   // Função para validar o formulário
   function validarForm() {
       const senhaValue = senha.value; //Obtem o valor do campo de senha
       const senha2Value = senha2.value;
       const exibir = document.querySelector('#message'); //Exibe uma mensagem

       // Verifica se a senha atende aos critérios de segurança
       if (!validarSenha(senhaValue)) {
           exibir.textContent = 'Senha inválida! A senha deve conter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, dígitos e caracteres especiais';
           exibir.style.color = 'red';
           senha.style.outline = '1px solid red';
           senha2.style.outline = '1px solid red';
           return false; // Impede o envio do formulário
       }

       // Verifica se as senhas coincidem
       if (senhaValue !== senha2Value) {
           exibir.textContent = 'Senhas não conferem, digite novamente.';
           exibir.style.color = 'red';
           senha.style.outline = '1px solid red';
           senha2.style.outline = '1px solid red';
           return false; // Impede o envio do formulário
       }

       // Se todas as validações passarem
       exibir.textContent = '';
       return true; // Permite o envio do formulário
   }

   // Função para verificar se a senha atende aos critérios de segurança
   function validarSenha(senha) {
       const temMaiscula = /[A-Z]/.test(senha);
       const temMinuscula = /[a-z]/.test(senha);
       const temDigito = /[0-9]/.test(senha);
       const temCaracterEspecial = /[!@#$%^&*(),.?":{}|<>]/.test(senha);
       const temOito = senha.length >= 8;

       return temMaiscula && temMinuscula && temDigito && temCaracterEspecial && temOito;
   }

function exibirAlerta() {
    alert('Cadastro bem sucedido!')
}

// Função para exibir a mensagem de flash
function showFlashMessage() {
    let flashMessage = document.getElementById('flash-message');
    flashMessage.style.display = 'block';
    setTimeout(() => {
        flashMessage.style.display = 'none';
    }, 5000); // A mensagem desaparecerá após 5 segundos
}

// Exibir a mensagem de flash ao carregar a página
window.onload = function() {
    showFlashMessage();
};


