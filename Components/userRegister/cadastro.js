function validarCadastro() {
  // Seleciona o formulário
      const formulario = document.getElementById("cadastroForm");
  // Obtém os dados do formulário
       const formData = new FormData(formulario);
        // Envia os dados usando a API Fetch
        fetch("cadastro.php", {
           method: "POST", // Define o método HTTP como POST
           body: formData, // Envia o objeto formData no corpo da requisição
        })
           .then((response) => response.json())
           .then((data) => {
            //document.getElementById("mensagem").innerHTML = data.mensagem;
                  if( data.success ) {
                    //window.location.href = "outra_pagina.html";
                        //document.getElementById("mensagem").innerHTML = "Gravado com sucesso";
                        alert("Usuário cadastrado!");
                        window.location.href = "../userLogin/login.html"
                    } else {
                      // Exibe a mensagem de erro na página
                      document.getElementById("mensagem").innerHTML = data.message;
                    }                 
              })
              .catch((error) => {
                console.error("Erro:", error);
                alert("Ocorreu um erro ao enviar o formulário.");// Mostra um alerta com a mensagem de erro
              });     
        }
  
  function Voltar() {
     window.location.href = "../userLogin/login.html";
  }