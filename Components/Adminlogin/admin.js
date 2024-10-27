function validarLogin() {
    // Obtém os valores dos campos de usuário e senha do formulário HTML
    var usuario = document.getElementById("usuario").value;
    var senha = document.getElementById("senha").value;

    // Verifica se algum dos campos (usuário ou senha) está vazio
    if (usuario === "" || senha === "") {
        // Se algum campo estiver vazio, exibe uma mensagem de erro no elemento com id "mensagem"
        document.getElementById("mensagem").innerText = "Por favor, preencha todos os campos.";
    } else {
        // Se os campos não estiverem vazios, procede com a validação
        const formulario = document.getElementById("adminloginForm");
        const formData = new FormData(formulario);

        fetch("adminLogin.php", {
            method: "POST",
            body: formData,
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Erro na resposta da rede'); // Lança um erro se a resposta não for OK
            }
            return response.json(); // Converte a resposta para JSON
        })
        .then((dados) => {
            if (dados.autenticado) {
                alert('Login realizado com sucesso!');
                window.location.href = "/Sem-Esperar-em-Filas/Components/AdminRegistros/AdminUser.php"; // Redireciona para a página inicial
            } else {
                document.getElementById("mensagem").innerText = 'Usuário ou senha inválidos!'; // Exibe mensagem de erro
            }
        })
        .catch((error) => {
            console.error("Erro:", error);
            alert("Ocorreu um erro ao enviar o formulário.");
        });     
    }
}
