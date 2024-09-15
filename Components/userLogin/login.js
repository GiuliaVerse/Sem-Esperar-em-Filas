function validarLogin() {
    var form = document.getElementById('loginForm');
    var formData = new FormData(form);

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
}


function cadastrar() {
    window.location.href = "../userRegister/cadastro.html";
 }
