function validarEmail(email) {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

function validarTelefone(telefone) {
  const regex = /^\(?\d{2}\)?[\s-]?[\s9]?\d{4}[\s-]?\d{4}$/;
  return regex.test(telefone);
}

function validarCPF(cpf) {
  cpf = cpf.replace(/[^\d]+/g, ''); // Remove qualquer coisa que não seja número

  if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
      return false; // Verifica se tem 11 dígitos ou se todos são iguais
  }

  // Validação dos dígitos verificadores
  let soma = 0;
  for (let i = 0; i < 9; i++) {
      soma += parseInt(cpf.charAt(i)) * (10 - i);
  }

  let resto = 11 - (soma % 11);
  let digito1 = resto === 10 || resto === 11 ? 0 : resto;

  if (digito1 !== parseInt(cpf.charAt(9))) {
      return false;
  }

  soma = 0;
  for (let i = 0; i < 10; i++) {
      soma += parseInt(cpf.charAt(i)) * (11 - i);
  }

  resto = 11 - (soma % 11);
  let digito2 = resto === 10 || resto === 11 ? 0 : resto;

  return digito2 === parseInt(cpf.charAt(10));
}

function validarCadastro() {
  // validação dos campos
  const cpf = document.getElementById("cpf").value;
  const email = document.getElementById("email").value;
  const telefone = document.getElementById("telefone").value;
  if( !validarCPF(cpf)) {
      alert("CPF inválido");
      return;
  } else if( !validarEmail(email)) {
      alert("E-mail inválido");
      return;
  } else if( !validarTelefone(telefone)) {
      alert("Telefone Inválido")
      return;
  }
    // Obtém o formulário de registro de restaurante
    var form = document.getElementById('registerForm');
    
    // Cria um objeto FormData que contém os dados do formulário
    var formData = new FormData(form);

    // Cria um novo objeto XMLHttpRequest para realizar a requisição AJAX
    var ajaxRequest = new XMLHttpRequest();
    
    // Configura a requisição AJAX com o método POST e o destino 'registroRestaurante.php' (ajaxRequest.open(method, url, async);)
    ajaxRequest.open('POST', 'cadastro.php', true);
    
    // Define o que fazer quando a resposta da requisição for recebida
    ajaxRequest.onload = function() {
        // Verifica se o status da requisição foi bem-sucedido (200 OK)
        if (ajaxRequest.status === 200) {
            // Converte a resposta JSON em um objeto JavaScript
            var response = JSON.parse(ajaxRequest.responseText);

            // Verifica se a resposta indica sucesso no registro
            if (response.success) {
                // Exibe um alerta de sucesso
                alert('Usuario registrado com sucesso!');
                
                // Reseta o formulário após o registro bem-sucedido
                form.reset();
                Voltar();
            } else {
                // Exibe uma mensagem de erro com base na resposta do servidor
                alert('Erro: ' + response.message);
            }
        } else {
            // Exibe uma mensagem de erro se a requisição não for bem-sucedida
            alert('Erro ao tentar registrar o usuario.');
        }
    };
    
    // Envia os dados do formulário via AJAX para o servidor
    ajaxRequest.send(formData);
}
  
  function Voltar() {
     window.location.href = "../LoginSelection/loginOption.html";
  }