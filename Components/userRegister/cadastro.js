// Adiciona um ouvinte de evento para o botão com id 'register'
document.getElementById('register').addEventListener('click', function(event) {
  event.preventDefault(); // Impede o comportamento padrão do botão (envio do formulário)
  validarCadastro(); // Chama a função de validação e envio via AJAX
});

// Adiciona um ouvinte de evento para o botão com id 'back'
document.getElementById('back').addEventListener('click', function(event) {
  event.preventDefault(); // Impede o comportamento padrão do botão (redirecionamento ou envio)
  goBack(); // Chama a função que redireciona para a página de login
});


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
            //document.getElementById("mensagem").innerHTML = data.mensagem;
                  if( data.success ) {
                    //window.location.href = "outra_pagina.html";
                        //document.getElementById("mensagem").innerHTML = "Gravado com sucesso";
                        alert("Usuário cadastrado!");
                        window.location.href = "../userLogin/login.html"
                    } else {
                      document.getElementById("mensagem").innerHTML = data.message;
                    }                 
              })
              .catch((error) => {
                console.error("Erro:", error);
                alert("Ocorreu um erro ao enviar o formulário.");
              });     
        }
  
function goBack() {
 // Redireciona o usuário para a página de login do restaurante
 window.location.href = "../userLogin/login.html";
}
      