function validarCadastroProduto() {
      // Seleciona o formulário pelo ID "productsRegistrationForm"
      const formulario = document.getElementById("productsRegistrationForm");
      
      // Cria um objeto FormData que contém todos os dados do formulário selecionado
      const formData = new FormData(formulario);
      
      // Envia os dados do formulário para o servidor usando a API Fetch
      fetch("products.php", {  // Faz uma requisição HTTP para o arquivo "products.php" no servidor
          method: "POST",      // Define o método da requisição como POST para enviar os dados
          body: formData       // O corpo da requisição é o objeto FormData contendo os dados do formulário
      })
      .then((response) => response.json())  // Converte a resposta recebida do servidor para o formato JSON
      .then((data) => {
          // Verifica se a resposta JSON indica sucesso
          if (data.success) {
              // Se o produto foi cadastrado com sucesso, exibe um alerta para o usuário
              alert("Produto cadastrado, será alocado a página assim que possível!");
              
              // Redireciona o usuário para a página de menu após o cadastro do produto
              window.location.href = "../menu/menu.php";
          } else {
              // Se houve um erro no cadastro, exibe a mensagem de erro retornada pelo servidor
              document.getElementById("mensagem").innerHTML = data.mensagem;
          }
      })
      .catch((error) => {
          // Captura e lida com qualquer erro que ocorrer durante a requisição
          console.error("Erro:", error);  // Loga o erro no console para depuração
          alert("Ocorreu um erro ao enviar o formulário.");  // Exibe um alerta de erro para o usuário
      });
  }
  
  function menu() {
      // Redireciona o usuário para a página de menu quando a função "menu" é chamada
      window.location.href = "components/menu/menu.php";
  }
  