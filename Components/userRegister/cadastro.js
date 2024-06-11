function validarCadastro() {
  /*
  let nome = document.getElementById("nome").value;
  let sobrenome = document.getElementById("sobrenome").value;
  let email = document.getElementById("email").value;
  let senha = document.getElementById("senha").value;
  let dataNascimento = new Date(document.getElementById("dataNascimento").value);
  let mensagem = document.getElementById("mensagem");

  if (nome === "" || sobrenome === "" || email === "" || senha === "" || dataNascimento === "") {
    //verifica se algum dos campos do formulário está vazio
      mensagem.innerHTML = "Todos os campos devem ser preenchidos.";
      //define o conteúdo do elemento HTML com o id mensagem para a mensagem "Todos os campos devem ser preenchidos.".
      return;
  }

  if (senha.length < 10) {
    mensagem.innerHTML = "Deve gravar uma senha forte de pelo menos 10 caracteres.";
    return;
  }

  let hoje = new Date(); //  a data e hora atuais do sistema. 
  let idade = hoje.getFullYear() - dataNascimento.getFullYear(); //.getFullYear() ano atual do sistema
  let mes = hoje.getMonth() - dataNascimento.getMonth();
  if (mes < 0 || (mes === 0 && hoje.getDate() < dataNascimento.getDate())) {
      idade--;
  //Verifica se o dia e mês de nascimento ainda não ocorreram este ano. 
  //Se o mês de nascimento for maior que o mês atual, ou se ambos forem iguais, 
  //Mas o dia de nascimento for maior que o dia atual, significa que o aniversário ainda não chegou.
  }

  if (idade < 18) {
      mensagem.innerHTML = "Usuário deve ter mais do que 18 anos.";
      return; 
  }

  let emailRegex = /^[\w-]+(\.[\w-]+)*@pucpr\.(br|edu\.br)$/i; //emailREgex é usado para validar endereços de e-mail.
  if (!emailRegex.test(email)) {
      mensagem.innerHTML = "Somente é permitido cadastrar um e-mail institucional da PUCPR.";
      return;
  }

  mensagem.innerHTML = "Gravado com sucesso";
  window.location.href = "login.html"; // Se o cadastro for validado com sucesso, redirecionar para a página de login
*/
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