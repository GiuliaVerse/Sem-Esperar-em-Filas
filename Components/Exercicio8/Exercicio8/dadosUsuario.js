function atualizar() {

    // Seleciona o formulário
    const formulario = document.getElementById("dadosUsuarioForm");
    // Obtém os dados do formulário
    const formData = new FormData(formulario);
    // Envia os dados usando a API Fetch
    fetch("editar.php", {
    method: "POST",
    body: formData,
    })
    .then((response) => response.json())
    .then((dados) => {
            if( dados.mensagem == "ok" ) {
                    document.getElementById("mensagem").innerText = "Atualizado com sucesso.";
                } else {
                    document.getElementById("mensagem").innerText = dados.mensagem;
                }     
            
        })
        .catch((error) => {
            console.error("Erro:", error);
            alert("Ocorreu um erro ao enviar o formulário.");
        });     
    
}

function excluir() {

    // Seleciona o formulário
    const formulario = document.getElementById("dadosUsuarioForm");
    // Obtém os dados do formulário
    const formData = new FormData(formulario);
    // Envia os dados usando a API Fetch
    fetch("excluir.php", {
    method: "POST",
    body: formData,
    })
    .then((response) => response.json())
    .then((dados) => {
            if( dados.mensagem == "ok" ) {
                    alert("Dados apagados com sucesso!");
                    window.location.href = "login.html"
                } else {
                    document.getElementById("mensagem").innerText = dados.mensagem;
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