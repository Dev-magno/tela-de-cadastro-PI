// Seleciona os elementos necessários
const showPassword = document.querySelector('#showPassword');
const senha = document.querySelector('#senha');
let mostrar = false; // Variável de controle para alternar entre mostrar e ocultar a senha

// Função para mostrar/ocultar a senha
showPassword.addEventListener('click', () => {
    if (mostrar) { // Se a senha estiver visível
        senha.type = 'password';
        showPassword.src = './img/olho_fechado.png';
        mostrar = false; // Atualiza o estado para "não mostrar"
    } else { // Se a senha estiver oculta
        senha.type = 'text';
        showPassword.src = './img/olho_aberto.png';
        mostrar = true; // Atualiza o estado para "mostrar"
    }
});

// Função para validar a senha
function validarSenha(senha) {
    // Verifica se a senha atende aos critérios de segurança
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    return regex.test(senha);
}

// Função para validar o formulário de login
function validarForm() {
    const senhaValue = senha.value;
    const exibir = document.querySelector('#message'); // Elemento para exibir mensagens de erro

    // Verifica se a senha atende aos critérios de segurança
    if (!validarSenha(senhaValue)) {
        exibir.textContent = 'Senha inválida! A senha deve conter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas e dígitos.';
        exibir.style.color = 'red';
        senha.style.outline = '1px solid red';
        return false; // Impede o envio do formulário
    }

    // Se todas as validações passarem
    exibir.textContent = '';
    return true; // Permite o envio do formulário
}
