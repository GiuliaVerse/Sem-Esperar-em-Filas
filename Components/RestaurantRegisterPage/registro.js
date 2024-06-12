function validateRegistration() {
    // Obtem o formulario
    var form = document.getElementById('restaurantRegistrationForm');
    var formData = new FormData(form);

    // Criando o objeto XML para realizar aquisiçao AJAX, Configura a requisiçao e define o destino da requisiçao php
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'registroRestaurante.php', true);
    // Resposta da requisiçao
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
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
    xhr.send(formData);
}

function goBack() {
    window.history.back();
}

