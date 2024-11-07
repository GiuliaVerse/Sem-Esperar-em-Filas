function validarLogin() {
  var usuario = document.getElementById("usuario").value;
  var senha = document.getElementById("senha").value;

  if (usuario === "" || senha === "") {
    Swal.fire({
      icon: "error",
      title: "Campo(s) vazio(s)",
      text: "Por favor, preencha todos os campos.",
    });
  } else {
    const formulario = document.getElementById("loginForm");

    const formData = new FormData(formulario);

    fetch("loginRestaurante.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((dados) => {
        // Verifica se o usuário foi autenticado a partir dos dados retornados
        if (dados.autenticado) {
          Swal.fire({
            icon: "success",
            title: "Login bem-sucedido!",
            text: "Você será redirecionado para a página inicial.",
            showConfirmButton: false,
            timer: 1500,
          }).then(() => {
            if (dados.tipo == "admin") {
              window.location.href =
                "/Sem-Esperar-em-Filas/Components/AdminRegistros/AdminUser.php";
            } else {
              window.location.href = "../../index.php";
            }
          });
        } else {
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
  window.location.href = "../RestaurantRegisterPage/RestauranteRegister.html";
}
