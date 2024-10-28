function validarLogin() {
    // Código de validação do login
    alert('Login validado!');
}

function cadastrar() {
    // Redirecionar para a página de cadastro
    window.location.href = 'cadastro.html';
}
// a partir daqui
function validarLogin() {
    var form = document.getElementById('loginForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'loginRestaurante.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.autenticado) {
                // Redirecionar para a página principal ou dashboard
                window.location.href =  "../../index.php";
            } else {
                alert('Erro: ' + response.mensagem);
            }
        } else {
            alert('Erro ao tentar realizar o login.');
        }
    };
    xhr.send(formData);
}

function cadastrar() {
    window.location.href = '../RestaurantRegisterPage/RestauranteRegister.html';
}