document.addEventListener('DOMContentLoaded', function() {
      const registerButton = document.getElementById('cadastrar');
      const backButton = document.getElementById('back');
      const valorProdutoInput = document.getElementById('ValorProduto');
  
      // Função para formatar o valor do produto no formato R$ XXX,XX
      function formatarValor(valor) {
          valor = valor.replace(/\D/g, ''); // Remove tudo que não for número
          if (valor.length > 2) {
              valor = valor.slice(0, -2) + ',' + valor.slice(-2); // Insere a vírgula para separar as casas decimais
          }
          return 'R$ ' + valor;
      }
  
      // Formata o valor do produto enquanto o usuário digita
      valorProdutoInput.addEventListener('input', function() {
          let rawValue = this.value.replace('R$ ', '').replace(',', ''); // Remove prefixo e vírgula para processamento
          this.value = formatarValor(rawValue);
  
          // Limita a quantidade de dígitos antes e depois da vírgula
          let value = rawValue;
          if (value.length > 5) {
              value = value.slice(0, 5);
          }
          this.value = formatarValor(value);
      });
  
      function validarCadastroProduto() {
          const form = document.getElementById('productsRegistrationForm');
          const inputs = form.querySelectorAll('input');
          let valid = true;
  
          // Remove a classe de erro dos campos existentes
          inputs.forEach(input => {
              input.classList.remove('is-invalid');
          });
  
          // Verifica se todos os campos obrigatórios estão preenchidos
          inputs.forEach(input => {
              if (input.value.trim() === '') {
                  input.classList.add('is-invalid');
                  valid = false;
              }
          });
  
          // Verifica se o campo Valor do Produto está no formato correto
          const valorProduto = valorProdutoInput.value.replace('R$ ', '');
          const regexValor = /^\d{1,3},\d{2}$/; // Regex para validar o formato XXX,XX
          if (!regexValor.test(valorProduto)) {
              alert('Por favor, insira o valor do produto no formato correto (R$ XXX,XX).');
              valorProdutoInput.classList.add('is-invalid');
              valid = false;
          }
  
          if (!valid) {
              alert('Por favor, preencha todos os campos obrigatórios corretamente.');
              return;
          }
  
          // Cria objeto FormData com os dados do formulário
          const formData = new FormData(form);
  
          fetch('products.php', {
              method: 'POST',
              body: formData,
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  alert('Produto cadastrado com sucesso!');
                  form.reset();
                  window.location.href = '../menu/menu.html';
              } else {
                  alert('Erro: ' + data.message);
              }
          })
          .catch(error => {
              console.error('Erro:', error);
              alert('Ocorreu um erro ao enviar o formulário.');
          });
      }
  
      function goBack() {
          window.history.back();
      }
  
      // Adiciona eventos de clique aos botões
      registerButton.addEventListener('click', validarCadastroProduto);
      backButton.addEventListener('click', goBack);
  });
  