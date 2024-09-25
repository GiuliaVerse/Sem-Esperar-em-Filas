function validarLogin() {
    var form = document.getElementById('loginForm');
    var formData = new FormData(form);

<<<<<<< HEAD
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
                        alert('Login realizado com sucesso!');
                        window.location.href = "../../index.php";
                    } else {
                        document.getElementById("mensagem").innerText = "Usuário não cadastrado.";
                    }     
                
            })
            .catch((error) => {
                console.error("Erro:", error);
                alert("Ocorreu um erro ao enviar o formulário.");
            });     
    }
=======
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.autenticado) {
                alert('Login realizado com sucesso!');
                // Redirecionar para a página principal ou dashboard
                window.location.href =  "../../index.html";
            } else {
                alert('Erro: ' + response.mensagem);
            }
        } else {
            alert('Erro ao tentar realizar o login.');
        }
    };
    xhr.send(formData);
>>>>>>> 6e5ee07e1b8aa75beada922ac4604f766a6a2529
}


function cadastrar() {
    window.location.href = "../userRegister/cadastro.html";
 }
