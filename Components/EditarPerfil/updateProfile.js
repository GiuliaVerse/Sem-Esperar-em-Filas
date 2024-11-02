function voltarPagina() {
    window.history.back();
}
document.getElementById('updateForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('/Sem-Esperar-em-Filas/Components/EditarPerfil/updateProfile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const responseMessage = document.getElementById('responseMessage');
        if (data.success) {
            responseMessage.innerHTML = 'Perfil atualizado com sucesso!';
            responseMessage.style.color = 'green';
        } else {
            responseMessage.innerHTML = 'Erro ao atualizar perfil: ' + data.message;
            responseMessage.style.color = 'red';
        }
    })
    .catch(error => {
        document.getElementById('responseMessage').innerHTML = 'Erro de requisição: ' + error;
        document.getElementById('responseMessage').style.color = 'red';
    });
});