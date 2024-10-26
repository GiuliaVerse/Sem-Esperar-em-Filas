// Adiciona um ouvinte de evento para o botão com id 'register'
document.getElementById('register').addEventListener('click', function(event) {
    event.preventDefault(); // Impede o comportamento padrão do botão (envio do formulário)
    validateRegistration(); // Chama a função de validação e envio via AJAX
});

// Adiciona um ouvinte de evento para o botão com id 'back'
document.getElementById('back').addEventListener('click', function(event) {
    event.preventDefault(); // Impede o comportamento padrão do botão (redirecionamento ou envio)
    goBack(); // Chama a função que redireciona para a página de login
});

function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function validarTelefone(telefone) {
    const regex = /^\(?\d{2}\)?[\s-]?[\s9]?\d{4}[\s-]?\d{4}$/;
    return regex.test(telefone);
}

function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, ''); // Remove tudo que não for número

    // Verifica se o CNPJ tem 14 dígitos
    if (cnpj.length !== 14) {
        return false;
    }

    // Elimina CNPJs inválidos conhecidos (como números iguais)
    if (/^(\d)\1+$/.test(cnpj)) {
        return false;
    }

    // Validação do primeiro dígito verificador
    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }

    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado !== parseInt(digitos.charAt(0))) {
        return false;
    }

    // Validação do segundo dígito verificador
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado !== parseInt(digitos.charAt(1))) {
        return false;
    }

    return true;
}

// Função responsável por validar e enviar os dados do formulário de registro
function validateRegistration() {

    const cnpj = document.getElementById("cnpj").value;
    const email = document.getElementById("email").value;
    const telefone = document.getElementById("phone").value;
    if( !validarCNPJ(cnpj)) {
        alert("CNPJ inválido");
        return;
    } else if( !validarEmail(email)) {
        alert("E-mail inválido");
        return;
    } else if( !validarTelefone(telefone)) {
        alert("Telefone Inválido")
        return;
    }


    // Obtém o formulário de registro de restaurante
    var form = document.getElementById('restaurantRegisterForm');
    
    // Cria um objeto FormData que contém os dados do formulário
    var formData = new FormData(form);

    // Cria um novo objeto XMLHttpRequest para realizar a requisição AJAX
    var ajaxRequest = new XMLHttpRequest();
    
    // Configura a requisição AJAX com o método POST e o destino 'registroRestaurante.php' (ajaxRequest.open(method, url, async);)
    ajaxRequest.open('POST', 'registroRestaurante.php', true);
    
    // Define o que fazer quando a resposta da requisição for recebida
    ajaxRequest.onload = function() {
        // Verifica se o status da requisição foi bem-sucedido (200 OK)
        if (ajaxRequest.status === 200) {
            // Converte a resposta JSON em um objeto JavaScript
            var response = JSON.parse(ajaxRequest.responseText);
            
            // Verifica se a resposta indica sucesso no registro
            if (response.success) {
                // Exibe um alerta de sucesso
                alert('Restaurante registrado com sucesso!');
                
                // Reseta o formulário após o registro bem-sucedido
                form.reset();
                goBack();
            } else {
                // Exibe uma mensagem de erro com base na resposta do servidor
                alert('Erro: ' + response.message);
            }
        } else {
            // Exibe uma mensagem de erro se a requisição não for bem-sucedida
            alert('Erro ao tentar registrar o restaurante.');
        }
    };
    
    // Envia os dados do formulário via AJAX para o servidor
    ajaxRequest.send(formData);
}

// Função responsável por redirecionar o usuário de volta para a página de login
function goBack() {
    // Redireciona o usuário para a página de login do restaurante
    window.location.href = "../LoginSelection/loginOption.html";
}
