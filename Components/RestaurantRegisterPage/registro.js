// Aguarda o carregamento completo do DOM antes de executar o código
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona os botões "Cadastrar" e "Voltar" pelo ID
    const registerButton = document.getElementById('register');
    const backButton = document.getElementById('back');

    // Função para formatar o CNPJ conforme o usuário digita
    function formatCNPJ(value) {
        // Remove todos os caracteres não numéricos do valor
        value = value.replace(/\D/g, '');
        // Limita o comprimento do CNPJ a 14 dígitos
        if (value.length > 14) value = value.slice(0, 14);
        // Aplica a formatação padrão do CNPJ
        return value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5');
    }

    // Função para formatar o telefone conforme o usuário digita
    function formatPhone(value) {
        // Remove todos os caracteres não numéricos do valor
        value = value.replace(/\D/g, '');

        // Aplica formatação para o código de área
        if (value.length <= 2) return `(${value}`;
        // Aplica formatação para o DDD e início do número
        if (value.length <= 7) return `(${value.slice(0, 2)}) ${value.slice(2)}`;
        // Aplica formatação completa para o número de telefone
        return `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7, 11)}`;
    }

    // Função para atualizar o valor do campo com a formatação correta
    function updateFieldFormat(event) {
        // Obtém o campo de input que gerou o evento
        const input = event.target;
        let formattedValue = '';

        // Aplica a formatação apropriada com base no ID do campo
        if (input.id === 'cnpj') {
            formattedValue = formatCNPJ(input.value);
        } else if (input.id === 'telefone') {
            formattedValue = formatPhone(input.value);
        }
        // Atualiza o valor do campo com a formatação
        input.value = formattedValue;
    }

    // Função para validar e registrar o restaurante
    function validateRegistration() {
        // Seleciona o formulário pelo ID
        const form = document.getElementById('restaurantRegisterForm');
        // Seleciona todos os campos de input dentro do formulário
        const inputs = form.querySelectorAll('input');
        let valid = true;

        // Remove a classe de erro dos campos existentes
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
        });

        // Verifica se todos os campos obrigatórios estão preenchidos
        inputs.forEach(input => {
            if (input.value.trim() === '') {
                // Adiciona a classe 'is-invalid' para campos vazios
                input.classList.add('is-invalid');
                valid = false;
            }
        });

        // Se algum campo não estiver válido, exibe um alerta e não envia o formulário
        if (!valid) {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return;
        }

        // Cria um objeto FormData com os dados do formulário
        const formData = new FormData(form);
        // Cria uma nova requisição AJAX
        const ajaxRequest = new XMLHttpRequest();
        ajaxRequest.open('POST', 'registroRestaurante.php', true);

        // Função que é chamada quando a requisição é concluída
        ajaxRequest.onload = function() {
            if (ajaxRequest.status === 200) {
                // Analisa a resposta JSON da requisição
                const response = JSON.parse(ajaxRequest.responseText);
                if (response.success) {
                    // Se a resposta indicar sucesso, exibe uma mensagem e reseta o formulário
                    alert('Restaurante registrado com sucesso!');
                    form.reset();
                } else {
                    // Caso contrário, exibe a mensagem de erro retornada
                    alert('Erro: ' + response.message);
                }
            } else {
                // Se o status da requisição não for 200, exibe uma mensagem de erro
                alert('Erro ao tentar registrar o restaurante.');
            }
        };

        // Envia a requisição com os dados do formulário
        ajaxRequest.send(formData);
    }

    // Função para voltar à página anterior
    function goBack() {
        window.history.back();
    }

    // Adiciona eventos de clique aos botões
    registerButton.addEventListener('click', validateRegistration);
    backButton.addEventListener('click', goBack);

    // Adiciona eventos de entrada para atualizar o formato dos campos
    const cnpjInput = document.getElementById('cnpj');
    const phoneInput = document.getElementById('telefone');
    cnpjInput.addEventListener('input', updateFieldFormat);
    phoneInput.addEventListener('input', updateFieldFormat);
});
