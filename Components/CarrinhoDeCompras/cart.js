if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

let totalAmount = "0,00";

function ready() {
    const buttonRemoverProdutos = document.getElementsByClassName("remove-product-button");
    for (let i = 0; i < buttonRemoverProdutos.length; i++) {
        buttonRemoverProdutos[i].addEventListener("click", removerProduto);
    }
    
    const qtdProdutos = document.getElementsByClassName("product-qtd-input");
    for (let i = 0; i < qtdProdutos.length; i++) {
        qtdProdutos[i].addEventListener("change", checarIfProdutoIsNull);
    }

    const adicionarAOCarrinho = document.getElementsByClassName("add-product-button");
    for (let i = 0; i < adicionarAOCarrinho.length; i++) {
        adicionarAOCarrinho[i].addEventListener("click", adicionarProduto);
    }

    const buttonComprar = document.getElementsByClassName("comprar-button")[0];
    buttonComprar.addEventListener("click", finalizarCompra);

    const buttonPrecoProdutos = document.getElementsByClassName("cart-product-price");
    for (let i = 0; i < buttonPrecoProdutos.length; i++) {
        buttonPrecoProdutos[i].addEventListener("click", alterarPrecoProduto);
    }

    const totalButton = document.getElementById("total-button");
    totalButton.addEventListener("click", updateTotal);
}

function removerProduto(event) {
    event.target.parentElement.parentElement.remove();
    updateTotal();
}

function checarIfProdutoIsNull(event) {
    if (event.target.value === "0") {
        event.target.parentElement.parentElement.remove();
    }
    updateTotal();
}

function adicionarProduto(event) {
    const button = event.target;
    const productInfos = button.parentElement.parentElement;
    const productImage = productInfos.getElementsByClassName("product-image")[0].src;
    const productName = productInfos.getElementsByClassName("product-title")[0].innerText;
    const preçoProduto = productInfos.getElementsByClassName("product-price")[0].innerText;

    const productosCartNames = document.getElementsByClassName("cart-product-title");
    for (let i = 0; i < productosCartNames.length; i++) {
        if (productosCartNames[i].innerText === productName) {
            productosCartNames[i].parentElement.parentElement.getElementsByClassName("product-qtd-input")[0].value++;
            updateTotal();
            return;
        }
    }

    let novoProduto = document.createElement("tr");
    novoProduto.classList.add("cart-product");

    novoProduto.innerHTML =
        `
    <td class="product-identification">
        <img src="${productImage}" alt="${productName}" class="cart-product-image">
        <strong class="cart-product-title">${productName}</strong>
    </td>
    <td>
        <span class="cart-product-price">${preçoProduto}</span>
    </td>
    <td>
        <input type="number" value="1" min="0" class="product-qtd-input">
        <button type="button" class="remove-product-button">Remover</button>
    </td>
    `;

    const tableBody = document.querySelector(".cart-table tbody");
    tableBody.append(novoProduto);
    updateTotal();

    novoProduto.getElementsByClassName("remove-product-button")[0].addEventListener("click", removerProduto);
    novoProduto.getElementsByClassName("product-qtd-input")[0].addEventListener("change", checarIfProdutoIsNull);
    novoProduto.getElementsByClassName("cart-product-price")[0].addEventListener("click", alterarPrecoProduto);
}

function finalizarCompra() {
    if (totalAmount === "0,00") {
        alert("Seu carrinho está vazio!");
    } else {   
        alert(
            `
            Obrigado pela sua compra!
            Valor do pedido: R$${totalAmount}\n
            Volte sempre :)
            `
        );

        document.querySelector(".cart-table tbody").innerHTML = "";
        updateTotal();
    }
}

function updateTotal() {
    const produtosDoCarrinho = document.getElementsByClassName("cart-product");
    totalAmount = 0;

    for (let i = 0; i < produtosDoCarrinho.length; i++) {
        const preçoProduto = produtosDoCarrinho[i].getElementsByClassName("cart-product-price")[0].innerText.replace("R$", "").replace(",", ".");
        const quantidadeProduto = produtosDoCarrinho[i].getElementsByClassName("product-qtd-input")[0].value;
        totalAmount += preçoProduto * quantidadeProduto;
    }

    totalAmount = totalAmount.toFixed(2);
    totalAmount = totalAmount.replace(".", ",");
    document.querySelector(".carrinho-total span").innerText = "R$" + totalAmount;
}

function alterarPrecoProduto(event) {
    const novoPreco = prompt("Digite o novo preço:");
    if (novoPreco) {
        const novoPrecoFormatado = "R$" + parseFloat(novoPreco).toFixed(2).replace(".", ",");
        event.target.innerText = novoPrecoFormatado;
        updateTotal();
    }
}
