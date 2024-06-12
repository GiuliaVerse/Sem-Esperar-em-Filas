function validarCadastro() {
// Seleciona o formulário
    const formulario = document.getElementById("cadastroForm");
// Obtém os dados do formulário
     const formData = new FormData(formulario);
      // Envia os dados usando a API Fetch
      fetch("cadastro.php", {
         method: "POST",
         body: formData,
      })
         .then((response) => response.json())
         .then((data) => {
          document.getElementById("mensagem").innerHTML = data.mensagem;
                if( data.mensagem == "ok" ) {
                  //window.location.href = "outra_pagina.html";
                      //document.getElementById("mensagem").innerHTML = "Gravado com sucesso";
                      alert("Usuário cadastrado!");
                      window.location.href = "login.html"
                  } else {
                    document.getElementById("mensagem").innerHTML = data.mensagem;
                  }                 
            })
            .catch((error) => {
              console.error("Erro:", error);
              alert("Ocorreu um erro ao enviar o formulário.");
            });     
      }

function login() {
   window.location.href = "login.html";
}