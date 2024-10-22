function validarCadastroCardapio() {
    // Seleciona o formulário pelo ID "productsRegistrationForm"
    const formulario = document.getElementById("cardapioRegistrationForm");
    
    // Cria um objeto FormData que contém todos os dados do formulário selecionado
    const formData = new FormData(formulario);
    

    fetch("cardapio.php", {
        method: "POST",      
        enctype: "multipart/form-data",
        body: formData       // O corpo da requisição é o objeto FormData contendo os dados do formulário
    })
    .then((response) => response.json())  // Converte a resposta recebida do servidor para o formato JSON
    .then((data) => {
        // Verifica se a resposta JSON indica sucesso
        if (data.success) {
            alert("Cardápio cadastrado, cadastre seus produtos!!");
            
            window.location.href = "../ProductPage/Products.html";
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
    window.location.href = "components/menu/menu.html";
}
