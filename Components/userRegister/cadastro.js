// Aguarda o carregamento completo do DOM antes de executar o código
document.addEventListener('DOMContentLoaded', function() {
  // Seleciona os botões "Cadastrar" e "Voltar" pelo ID
  const registerButton = document.getElementById('register');
  const backButton = document.getElementById('back');

   // Função para formatar o CPF conforme o usuário digita
   function formatCPF(value) {
    // Remove todos os caracteres não numéricos do valor
    value = value.replace(/\D/g, '');

    // Limita o comprimento do CPF a 11 dígitos
    if (value.length > 11) value = value.slice(0, 11);

    // Aplica a formatação padrão do CPF
    return value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');
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
    if (input.id === 'cpf') {
        formattedValue = formatCPF(input.value);
    } else if (input.id === 'telefone') {
        formattedValue = formatPhone(input.value);
    }
    // Atualiza o valor do campo com a formatação
    input.value = formattedValue;
}
  // Função para validar e registrar o restaurante
  function validateRegistration() {
      // Seleciona o formulário pelo ID
      const form = document.getElementById('userRegisterForm');
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
      ajaxRequest.open('POST', 'cadastro.php.php', true);

      // Função que é chamada quando a requisição é concluída
      ajaxRequest.onload = function() {
          if (ajaxRequest.status === 200) {
              // Analisa a resposta JSON da requisição
              const response = JSON.parse(ajaxRequest.responseText);
              if (response.success) {
                  // Se a resposta indicar sucesso, exibe uma mensagem e reseta o formulário
                  alert('Usuário registrado com sucesso!');
                  form.reset();
              } else {
                  // Caso contrário, exibe a mensagem de erro retornada
                  alert('Erro: ' + response.message);
              }
          } else {
              // Se o status da requisição não for 200, exibe uma mensagem de erro
              alert('Erro ao tentar registrar o usuário.');
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
  const cpfInput = document.getElementById('cpf');
  const phoneInput = document.getElementById('telefone');
  cpfInput.addEventListener('input', updateFieldFormat);
  phoneInput.addEventListener('input', updateFieldFormat);
});


