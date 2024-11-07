function validarLogin() {
  // Obtém os valores dos campos de usuário e senha do formulário HTML
  var usuario = document.getElementById("usuario").value;
  var senha = document.getElementById("senha").value;

  // Verifica se algum dos campos (usuário ou senha) está vazio
  if (usuario === "" || senha === "") {
    // Se algum campo estiver vazio, exibe uma mensagem de erro com SweetAlert
    Swal.fire({
      icon: "error",
      title: "Campo(s) vazio(s)",
      text: "Por favor, preencha todos os campos.",
    });
  } else {
    // Seleciona o formulário de login pelo id "loginForm"
    const formulario = document.getElementById("loginForm");

    // Cria um objeto FormData contendo os dados do formulário para enviar via POST
    const formData = new FormData(formulario);

    fetch("loginRestaurante.php", {
      method: "POST", // Define o método como POST
      body: formData, // Define o corpo da requisição com os dados do formulário
    })
      .then((response) => response.json()) // Converte a resposta para JSON
      .then((dados) => {
        // Verifica se o usuário foi autenticado a partir dos dados retornados
        if (dados.autenticado) {
          // Se autenticado, exibe um alerta de sucesso com SweetAlert e redireciona o usuário
          Swal.fire({
            icon: "success",
            title: "Login bem-sucedido!",
            text: "Você será redirecionado para a página inicial.",
            showConfirmButton: false,
            timer: 1500,
          }).then(() => {
            if (dados.tipo == "admin") {
              window.location.href =
                "/Sem-Esperar-em-Filas/Components/AdminRegistros/AdminUser.php"; // Redireciona para a página de admin
            } else {
              window.location.href = "../../index.php"; // Redireciona para a página inicial
            }
          });
        } else {
          // Se não autenticado, exibe uma mensagem de erro com SweetAlert
          if (dados.usuario)
            Swal.fire({
              icon: "error",
              title: "Usuário ou senha inválidos!",
              text: "Verifique suas credenciais e tente novamente.",
            });
          else
            Swal.fire({
              icon: "error",
              title: "Usuário não cadastrado!",
              text: "Não encontramos um usuário com esse e-mail ou nome de usuário. Verifique e tente novamente.",
            });
        }
      })
      .catch((error) => {
        console.error("Erro:", error);
        Swal.fire({
          icon: "error",
          title: "Usuário ou senha inválidos!",
          text: "Verifique suas credenciais e tente novamente.",
        });
      });
  }
}

function cadastrar() {
  // Redireciona para a página de cadastro
  window.location.href = "../RestaurantRegisterPage/RestauranteRegister.html";
}
