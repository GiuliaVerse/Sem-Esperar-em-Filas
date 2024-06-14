function validarCadastroProduto() {
    // Seleciona o formulário
        const formulario = document.getElementById("productsRegistrationForm");
    // Obtém os dados do formulário
         const formData = new FormData(formulario);
          // Envia os dados usando a API Fetch
          fetch("products.php", {
             method: "POST",
             body: formData,
          })
             .then((response) => response.json())
             .then((data) => {
              // document.getElementById("mensagem").innerHTML = data.mensagem;
                    if( data.success ) {
                          alert("Produto cadastrado, será alocado a página assim que possível!");
                          window.location.href = "../menu/menu.html"
                      } else {
                        document.getElementById("mensagem").innerHTML = data.mensagem;
                      }                 
                })
                .catch((error) => {
                  console.error("Erro:", error);
                  alert("Ocorreu um erro ao enviar o formulário.");
                });     
          }
    
    function menu() {
       window.location.href = "components/menu/menu.html";
    }