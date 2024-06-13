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

    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.open('POST', 'loginRestaurante.php', true);
    ajaxRequest.onload = function() {
        if (ajaxRequest.status === 200) {
            var response = JSON.parse(ajaxRequest.responseText);
            if (response.autenticado) {
                alert('Login realizado com sucesso!');
                // Redirecionar para a página principal ou dashboard
                window.location.href = 'dashboard.html';
            } else {
                alert('Erro: ' + response.mensagem);
            }
        } else {
            alert('Erro ao tentar realizar o login.');
        }
    };
    ajaxRequest.send(formData);
}

function cadastrar() {
    window.location.href = 'registroRestaurante.html';
}
