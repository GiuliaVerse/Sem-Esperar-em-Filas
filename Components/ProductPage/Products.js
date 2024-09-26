function validarCadastroProduto() {
    // Seleciona o formulário pelo ID "productsRegistrationForm"
    const formulario = document.getElementById("productsRegistrationForm");

    // Cria um objeto FormData que contém todos os dados do formulário selecionado
    const formData = new FormData(formulario);

    const inputs = formulario.querySelectorAll('input');
    let valid = true;

    // Remove a classe de erro dos campos existentes
    inputs.forEach(input => {
        input.classList.remove('is-invalid');
    });

    // Verifica se todos os campos obrigatórios estão preenchidos
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            input.classList.add('is-invalid');
            valid = false;
        }
    });

    // Verifica se o campo Valor do Produto está preenchido
    const valorProdutoInput = document.getElementById('ValorProduto');
    const valorProduto = valorProdutoInput.value.replace('R$ ', '').replace(',', '.'); // Troca a vírgula por um ponto
    formData.set('ValorProduto', valorProduto); // Atualiza o valor no FormData

    // Aqui você pode adicionar qualquer outra validação que desejar
    if (!valorProdutoInput.value.trim()) {
        alert('Por favor, insira o valor do produto.');
        valorProdutoInput.classList.add('is-invalid');
        valid = false;
    }

    if (!valid) {
        alert('Por favor, preencha todos os campos obrigatórios corretamente.');
        return;
    }

    // Envia os dados do formulário para o servidor usando a API Fetch
    fetch("products.php", {
        method: "POST",
        body: formData
    })
    .then((response) => response.json())
    .then((data) => {
        // Verifica se a resposta JSON indica sucesso
        if (data.success) {
            // Se o produto foi cadastrado com sucesso, exibe um alerta para o usuário
            alert("Produto cadastrado, será alocado a página assim que possível!");
            formulario.reset(); // Reseta o formulário após o cadastro
            // Redireciona o usuário para a página de menu após o cadastro do produto
            window.location.href = "../menu/menu.html";
        } else {
            // Se houve um erro no cadastro, exibe a mensagem de erro retornada pelo servidor
            alert('Erro: ' + data.message);
        }
    })
    .catch((error) => {
        // Captura e lida com qualquer erro que ocorrer durante a requisição
        console.error("Erro:", error);
        alert("Ocorreu um erro ao enviar o formulário.");
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const valorProdutoInput = document.getElementById('ValorProduto');

    // Função para formatar o valor do produto no formato R$ XXX,XX
    function formatarValor(valor) {
        valor = valor.replace(/\D/g, ''); // Remove tudo que não for número
        if (valor.length > 2) {
            valor = valor.slice(0, -2) + ',' + valor.slice(-2); // Insere a vírgula para separar as casas decimais
        }
        return 'R$ ' + valor;
    }

    // Formata o valor do produto enquanto o usuário digita
    valorProdutoInput.addEventListener('input', function() {
        let rawValue = this.value.replace('R$ ', '').replace(',', ''); // Remove prefixo e vírgula para processamento
        this.value = formatarValor(rawValue);

        // Limita a quantidade de dígitos antes e depois da vírgula
        let value = rawValue;
        if (value.length > 5) {
            value = value.slice(0, 5);
        }
        this.value = formatarValor(value);
    });
});
