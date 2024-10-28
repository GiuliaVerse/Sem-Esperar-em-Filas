function validarLogin() {
    // Código de validação do login
    alert('Login validado!');
}

function cadastrar() {
    // Redirecionar para a página de cadastro
    window.location.href = 'cadastro.html';
}

function validarLogin() {
    var usuario = document.getElementById("usuario").value;
    var senha = document.getElementById("senha").value;

    if (usuario === "" || senha === "") {
        // Se algum campo estiver vazio, exibe uma mensagem de erro no elemento com id "mensagem"
        document.getElementById("mensagem").innerText = "Por favor, preencha todos os campos.";
    } 
    else {

        const formulario = document.getElementById("loginForm");

        // Cria um objeto FormData contendo os dados do formulário para enviar via POST
        const formData = new FormData(formulario);

        fetch("loginRestaurante.php", {
            method: "POST", // Define o método como POST
            body: formData, // Define o corpo da requisição com os dados do formulário
        })
        .then((response) => response.json()) // Converte a resposta para JSON
        .then((dados) => {
            // Verifica se o usuário foi autenticado a partir dos dados retornados
            if(dados.autenticado) {
                // Se autenticado, exibe um alerta de sucesso e redireciona o usuário
                if(dados.tipo == 'admin') {
                    window.location.href = "/Sem-Esperar-em-Filas/Components/AdminRegistros/AdminUser.php"; // Redireciona para a página inicial
                } else {
                    window.location.href = "../../index.php"; // Redireciona para a página inicial
                }
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
    window.location.href = '../RestaurantRegisterPage/RestauranteRegister.html';
}