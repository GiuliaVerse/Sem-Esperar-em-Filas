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
    window.history.back();
}


const register = document.getElementById('register');

register.addEventListener('click',function(){
    let razaoSocial = document.getElementById('razaoSocial').value;
    let nomeFantasia = document.getElementById('nomeFantasia').value;
    let email = document.getElementById('email').value;
    let cnpj = document.getElementById('cnpj').value;
    let telefone = document.getElementById('telefone').value;
    let instituicao = document.getElementById('instituicao').value;
    let usuario = document.getElementById('usuario').value;
    let senha = document.getElementById('senha').value;
    let data = [razaoSocial,nomeFantasia,email,cnpj,telefone,instituicao,usuario,senha];
    for(let i = 0; i < data.length; i++){
        alert(data[i]);
    }
});
