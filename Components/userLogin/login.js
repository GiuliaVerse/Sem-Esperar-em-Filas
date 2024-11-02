function validarLogin() {
    // Obtém os valores dos campos de usuário e senha do formulário HTML
    var usuario = document.getElementById("usuario").value;
    var senha = document.getElementById("senha").value;

    // Verifica se algum dos campos (usuário ou senha) está vazio
    if (usuario === "" || senha === "") {
        document.getElementById("mensagem").innerText = "Por favor, preencha todos os campos.";
    } else {
        const formulario = document.getElementById("loginForm");
        const formData = new FormData(formulario);

        // Envia os dados para o arquivo "login.php" usando o método fetch
        fetch("login.php", {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((dados) => {
            // Verifica se o usuário foi autenticado a partir dos dados retornados
            if(dados.autenticado) {
                // Armazena o ID do usuário logado no localStorage
                localStorage.setItem('loggedUserId', dados.id);

                // Redireciona o usuário conforme o tipo de conta
                if(dados.tipo === 'admin') {
                    window.location.href = "/Sem-Esperar-em-Filas/Components/AdminRegistros/AdminUser.php";
                } else {
                    window.location.href = "../../index.php";
                }
            } else {
                alert('Usuário ou senha inválidos!');
            }
        })
        .catch((error) => {
            console.error("Erro:", error);
            alert("Ocorreu um erro ao enviar o formulário.");
        });
    }
}

function cadastrar() {
    window.location.href = "../userRegister/cadastro.html";
}

function login() {
    window.location.href = "login.html";
}
