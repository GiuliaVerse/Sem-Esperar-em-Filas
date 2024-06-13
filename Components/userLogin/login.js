function validarLogin() {
    // Obtém os valores dos campos de usuário e senha
    var usuario = document.getElementById("usuario").value;
    var senha = document.getElementById("senha").value;

    // Verifica se os campos estão vazios
    if (usuario === "" || senha === "") {
        // Se algum campo estiver vazio, exibe mensagem de erro
        document.getElementById("mensagem").innerText = "Por favor, preencha todos os campos.";
    } 
    else {
        // Seleciona o formulário
        const formulario = document.getElementById("loginForm");
        // Obtém os dados do formulário
        const formData = new FormData(formulario);
        // Envia os dados usando a API Fetch
        fetch("login.php", {
        method: "POST",
        body: formData,
        })
        .then((response) => response.json())
        .then((dados) => {
                if( dados.autenticado ) {
                        //document.getElementById("mensagem").innerText = "Usuário autenticado com sucesso.";
                        window.location.href = "../../index.html";
                    } else {
                        document.getElementById("mensagem").innerText = "Usuário não cadastrado.";
                    }     
                
            })
            .catch((error) => {
                console.error("Erro:", error);
                alert("Ocorreu um erro ao enviar o formulário.");
            });     
    }
}

function cadastrar() {
    window.location.href = "cadastro.html";
 }

function login() {
    window.location.href = "login.html";
}