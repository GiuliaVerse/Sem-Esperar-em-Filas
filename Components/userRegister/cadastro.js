function validarCadastro() {
  // Seleciona o formulário pelo ID "cadastroForm"
  const formulario = document.getElementById("cadastroForm");

  // Obtém os dados do formulário usando a classe FormData
  const formData = new FormData(formulario);

  // Envia os dados usando a API Fetch com o método POST
  fetch("cadastro.php", {
      method: "POST", // Define o método como POST para enviar os dados
      body: formData, // Envia os dados do formulário
  })
      .then((response) => response.json()) // Converte a resposta para JSON
      .then((data) => {
          // Verifica se o cadastro foi bem-sucedido
          if (data.success) {
              // Se o cadastro for bem-sucedido, exibe um alerta
              alert("Usuário cadastrado!");

              // Redireciona o usuário para a página de login
              window.location.href = "../userLogin/login.html";
          } else {
              // Se houver algum erro no cadastro, exibe a mensagem de erro no HTML
              document.getElementById("mensagem").innerHTML = data.message;
          }
      })
      .catch((error) => {
          // Caso ocorra algum erro durante o envio da requisição
          console.error("Erro:", error); // Exibe o erro no console
          alert("Ocorreu um erro ao enviar o formulário."); // Exibe um alerta de erro
      });
}

function Voltar() {
  // Redireciona o usuário de volta para a página de login
  window.location.href = "../userLogin/login.html";
}
