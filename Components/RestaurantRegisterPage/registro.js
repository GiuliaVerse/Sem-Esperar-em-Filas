// Adiciona um ouvinte de evento para o botão com id 'register'
document.getElementById('register').addEventListener('click', function(event) {
    event.preventDefault(); // Impede o comportamento padrão do botão (envio do formulário)
    validateRegistration(); // Chama a função de validação e envio via AJAX
});

// Adiciona um ouvinte de evento para o botão com id 'back'
document.getElementById('back').addEventListener('click', function(event) {
    event.preventDefault(); // Impede o comportamento padrão do botão (redirecionamento ou envio)
    goBack(); // Chama a função que redireciona para a página de login
});

// Função responsável por validar e enviar os dados do formulário de registro
function validateRegistration() {
    // Obtém o formulário de registro de restaurante
    var form = document.getElementById('restaurantRegisterForm');
    
    // Cria um objeto FormData que contém os dados do formulário
    var formData = new FormData(form);

    // Cria um novo objeto XMLHttpRequest para realizar a requisição AJAX
    var ajaxRequest = new XMLHttpRequest();
    
    // Configura a requisição AJAX com o método POST e o destino 'registroRestaurante.php'
    ajaxRequest.open('POST', 'registroRestaurante.php', true);
    
    // Define o que fazer quando a resposta da requisição for recebida
    ajaxRequest.onload = function() {
        // Verifica se o status da requisição foi bem-sucedido (200 OK)
        if (ajaxRequest.status === 200) {
            // Converte a resposta JSON em um objeto JavaScript
            var response = JSON.parse(ajaxRequest.responseText);
            
            // Verifica se a resposta indica sucesso no registro
            if (response.success) {
                // Exibe um alerta de sucesso
                alert('Restaurante registrado com sucesso!');
                
                // Reseta o formulário após o registro bem-sucedido
                form.reset();
            } else {
                // Exibe uma mensagem de erro com base na resposta do servidor
                alert('Erro: ' + response.message);
            }
        } else {
            // Exibe uma mensagem de erro se a requisição não for bem-sucedida
            alert('Erro ao tentar registrar o restaurante.');
        }
    };
    
    // Envia os dados do formulário via AJAX para o servidor
    ajaxRequest.send(formData);
}

// Função responsável por redirecionar o usuário de volta para a página de login
function goBack() {
    // Redireciona o usuário para a página de login do restaurante
    window.location.href = "../RestaurantLogin/RestaurantLogin.html";
}
