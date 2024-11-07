function validarCadastroCardapio() {
    const formulario = document.getElementById("cardapioRegistrationForm");
    
    // Verifica se todos os campos obrigatórios estão preenchidos
    const inputs = formulario.querySelectorAll("input[required], select[required], textarea[required]");
    let formValido = true;
    
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
            icon: "error",
            title: "Erro!",
            text: "Por favor, preencha todos os campos obrigatórios.",
            confirmButtonText: "Fechar",
        });
        return;  // Impede que o formulário seja enviado
    }

    const formData = new FormData(formulario);

    fetch("cardapio.php", {
        method: "POST",
        enctype: "multipart/form-data",
        body: formData, // O corpo da requisição é o objeto FormData contendo os dados do formulário
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Cardápio Cadastrado!",
                    text: "Cardápio cadastrado com sucesso, cadastre seus produtos!!",
                    confirmButtonText: "Ok",
                }).then(() => {
                    window.location.href = "../ProductPage/ProductsPage.php";
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Ocorreu um erro ao enviar o formulário.",
                    text: data.mensagem,
                    confirmButtonText: "Fechar",
                });
            }
        })
}

function menu() {
    window.location.href = "components/menu/menu.php";
}
