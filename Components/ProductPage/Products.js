function validarCadastroProduto() {
    const formulario = document.getElementById("productsRegistrationForm");

    // Verificar se todos os campos obrigatórios estão preenchidos
    const inputs = formulario.querySelectorAll("input[required], select[required], textarea[required]");
    let formValido = true;

    // Loop para verificar se algum campo obrigatório está vazio
    inputs.forEach((input) => {
        if (!input.value.trim()) {
            formValido = false;
            input.style.borderColor = "red";  // Marca o campo que não foi preenchido
        } else {
            input.style.borderColor = "";  // Reseta a cor do campo
        }
    });

    if (!formValido) {
        Swal.fire({
            icon: 'error',
            title: 'Campos obrigatórios!',
            text: 'Por favor, preencha todos os campos obrigatórios.',
            confirmButtonText: 'Fechar',
        });
        return;
    }

    // Cria um objeto FormData com os dados do formulário
    const formData = new FormData(formulario);

    // Envia os dados do formulário para o servidor usando a API Fetch
    fetch("products.php", {
        method: "POST",
        body: formData
    })
        .then((response) => response.json())  // Converte a resposta do servidor para JSON
        .then((data) => {
            // Verifica se a resposta JSON indica sucesso
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Produto Cadastrado!',
                    text: 'Produto cadastrado com sucesso!',
                    confirmButtonText: 'Ok',
                }).then(() => {
                    window.location.href = "../menu/menu.php";  // Redireciona o usuário para a página de menu
                });
            } else {
                // Se houve erro no servidor, exibe a mensagem de erro
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: data.mensagem,
                    confirmButtonText: 'Fechar',
                });
            }
        })
}

function menu() {
    window.location.href = "components/menu/menu.php";
}

document.addEventListener("DOMContentLoaded", function () {
    fetch(`GetCardapios.php?`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Erro:", data.error);
                return;
            }

            const select = document.getElementById('Cardapio');
            data.forEach(cardapio => {
                const option = document.createElement('option');
                option.value = cardapio.codigo_cardapio;
                option.textContent = cardapio.nome_cardapio;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error("Erro ao buscar cardápios:", error);
        });
});
