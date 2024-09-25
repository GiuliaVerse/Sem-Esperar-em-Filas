document.getElementById('register').addEventListener('click', function(event) {
    event.preventDefault(); // Prevenir envio padrão do formulário
    validateRegistration(); // Chama a função de validação e envio via AJAX
});

document.getElementById('back').addEventListener('click', function(event) {
    event.preventDefault(); // Previne ação padrão do botão
    goBack(); // Chama a função de voltar
});

function validateRegistration() {
    // Obtem o formulario
    var form = document.getElementById('restaurantRegisterForm');
    var formData = new FormData(form);

    // Criando o objeto XML para realizar aquisiçao AJAX, Configura a requisiçao e define o destino da requisiçao php
    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.open('POST', 'registroRestaurante.php', true);
    // Resposta da requisiçao
    ajaxRequest.onload = function() {
        if (ajaxRequest.status === 200) {
            var response = JSON.parse(ajaxRequest.responseText);
            if (response.success) {
                alert('Restaurante registrado com sucesso!');
                form.reset();
            } else {
                alert('Erro: ' + response.message);
            }
        } else {
            alert('Erro ao tentar registrar o restaurante.');
        }
    };
    // Envia a requisiçao
    ajaxRequest.send(formData);
}

function goBack() {
    window.location.href = "../RestaurantLogin/RestaurantLogin.html";
}

