function validarLogin() {
    // Obtém os valores dos campos de usuário e senha do formulário HTML
    var usuario = document.getElementById("usuario").value;
    var senha = document.getElementById("senha").value;

    // Verifica se algum dos campos (usuário ou senha) está vazio
    if (usuario === "" || senha === "") {
        // Se algum campo estiver vazio, exibe uma mensagem de erro no elemento com id "mensagem"
        document.getElementById("mensagem").innerText = "Por favor, preencha todos os campos.";
    } 
    else {
        // Se os campos não estiverem vazios, procede com a validação

        // Seleciona o formulário de login pelo id "loginForm"
        const formulario = document.getElementById("loginForm");

        // Cria um objeto FormData contendo os dados do formulário para enviar via POST
        const formData = new FormData(formulario);

        // Envia os dados para o arquivo "login.php" usando o método fetch (API Fetch)
        fetch("login.php", {
            method: "POST", // Define o método como POST
            body: formData, // Define o corpo da requisição com os dados do formulário
        })
        .then((response) => response.json()) // Converte a resposta para JSON
        .then((dados) => {
            // Verifica se o usuário foi autenticado a partir dos dados retornados
            if(dados.autenticado) {
                // Se autenticado, exibe um alerta de sucesso e redireciona o usuário
                alert('Login realizado com sucesso!');
                window.location.href = "../../index.php"; // Redireciona para a página inicial
            } else {
                // Se não autenticado, exibe uma mensagem de erro no elemento com id "mensagem"
                alert('Usuário ou senha inválidos!');
            }
        })
        .catch((error) => {
            // Em caso de erro na requisição, exibe o erro no console e um alerta
            console.error("Erro:", error);
            alert("Ocorreu um erro ao enviar o formulário.");
        });     
    }
}

function cadastrar() {
    // Redireciona o usuário para a página de cadastro
    window.location.href = "../userRegister/cadastro.html";
}

function login() {
    // Redireciona o usuário para a página de login
    window.location.href = "login.html";
}