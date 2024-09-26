// Função para validar o login
function validarLogin() {
    // Obtém o formulário de login pelo ID 'loginForm'
    var form = document.getElementById('loginForm');

    // Cria um objeto FormData com os dados do formulário
    var formData = new FormData(form);

    // Cria um objeto XMLHttpRequest para fazer uma requisição HTTP
    var xhr = new XMLHttpRequest();

    // Abre uma requisição POST para o arquivo 'loginRestaurante.php'
    xhr.open('POST', 'loginRestaurante.php', true);

    // Define o que fazer quando a requisição for carregada (onload)
    xhr.onload = function() {
        // Verifica se a requisição foi bem-sucedida (status 200)
        if (xhr.status === 200) {
            // Converte a resposta da requisição para JSON
            var response = JSON.parse(xhr.responseText);

            // Verifica se o login foi autenticado
            if (response.autenticado) {
                // Se o login foi bem-sucedido, exibe um alerta de sucesso
                alert('Login realizado com sucesso!');
                // Redireciona para a página principal ou dashboard
                window.location.href = "../../index.php";
            } else {
                // Se a autenticação falhou, exibe a mensagem de erro retornada
                alert('Erro: ' + response.mensagem);
            }
        } else {
            // Caso o status da requisição não seja 200, exibe um alerta de erro
            alert('Erro ao tentar realizar o login.');
        }
    };

    // Envia os dados do formulário para o servidor
    xhr.send(formData);
}

// Função para redirecionar o usuário para a página de cadastro de restaurante
function cadastrar() {
    // Redireciona o usuário para a página 'RestauranteRegister.html'
    window.location.href = '../RestaurantRegisterPage/RestauranteRegister.html';
}
