// Verifica se o documento está carregando. Se estiver, adiciona um listener para quando o DOM estiver completamente carregado.
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    // Se o documento já estiver carregado, chama a função ready imediatamente.
    ready();
}

// Recupera o carrinho atual do localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || [];

const cartContainer = document.getElementById('cartContainer');

const renderCartItems = () => {
    cartContainer.innerHTML = '';

    if (cart.length === 0) {
        cartContainer.innerHTML = '<p>Seu carrinho está vazio.</p>';
        return;
    }
/*
    cart.forEach(item => {
        const cardElement =
        `<!-- Produtos adicionados ao carrinho irão aparecer aqui -->
        <div class="cart-items">
            <div class="cart-product">
            <button class="photo-button">
                <img src="../../Components/Images/icone-adicionar-foto.jpg" alt="Adicionar Foto">
            </button>
            <div class="product-details">
                <p class="cart-product-title">${item.name}</p>
                <p class="cart-product-price">R$50,00</p>
            </div>
            <input type="number" class="product-qtd-input" value="1">
            <button id="remover" class="remove-product-button">Remover</button>
        </div>`;
    cardContainer.innerHTML += cardElement;
    });
    cardContaider.innerHTML += `<\div>`
*/
    cart.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('cart-product');
        const price = parseFloat(item.price).toFixed(2);
        itemDiv.innerHTML = `
                <button class="photo-button">
                    <img src="../../Components/Images/icone-adicionar-foto.jpg" alt="Adicionar Foto">
                </button>
                <div class="product-details">
                    <p class="cart-product-title">${item.name}</p>
                    <p class="cart-product-price">R$ ${price}</p>
                </div>
                <input type="number" class="product-qtd-input" value="${item.quantity}">
                <button id="remover" class="remove-product-button">Remover</button>
        `;
        cartContainer.appendChild(itemDiv);
    });

};

// Inicializa o valor total do carrinho como "0,00".
let totalAmount = "0,00";

// Função que configura os listeners e inicializa o carrinho.
function ready() {

    renderCartItems();
    configura();
}

function configura() {

    // Adiciona listeners de clique para todos os botões de remover produto.
    const buttonRemoverProdutos = document.getElementsByClassName("remove-product-button");
    for (let i = 0; i < buttonRemoverProdutos.length; i++) {
        buttonRemoverProdutos[i].addEventListener("click", removerProduto);
    }
    
    // Adiciona listeners de mudança para todos os campos de quantidade de produto.
    const qtdProdutos = document.getElementsByClassName("product-qtd-input");
    for (let i = 0; i < qtdProdutos.length; i++) {
        qtdProdutos[i].addEventListener("change", checarIfProdutoIsNull);
    }

    // Adiciona listeners de clique para todos os botões de adicionar produto.
    const adicionarAOCarrinho = document.getElementsByClassName("add-product-button");
    for (let i = 0; i < adicionarAOCarrinho.length; i++) {
        adicionarAOCarrinho[i].addEventListener("click", adicionarProduto);
    }

    // Adiciona listener de clique para o botão de comprar.
    const buttonComprar = document.getElementsByClassName("comprar-button")[0];
    buttonComprar.addEventListener("click", finalizarCompra);

    // Adiciona listeners de clique para todos os preços de produtos no carrinho, permitindo alteração.
    const buttonPrecoProdutos = document.getElementsByClassName("cart-product-price");
    for (let i = 0; i < buttonPrecoProdutos.length; i++) {
        buttonPrecoProdutos[i].addEventListener("click", alterarPrecoProduto);
    }

    // Adiciona listeners de clique para todos os botões de foto.
    const photoButtons = document.getElementsByClassName("photo-button");
    for (let i = 0; i < photoButtons.length; i++) {
        photoButtons[i].addEventListener("click", showPhotoAlert);
    }

    // Calcula e atualiza o total inicial do carrinho.
    updateTotal();
}

// Função para remover um produto do carrinho.
function removerProduto() {
//    cart.splice(i, 1);
//    localStorage.setItem('cart', JSON.stringify(cart));

    // Remove o produto clicado.
    event.target.parentElement.remove();
    // Atualiza o valor total do carrinho.
    updateTotal();
}

// Função para checar se a quantidade do produto é zero e removê-lo se for.
function checarIfProdutoIsNull(event) {
    // Verifica se a quantidade do produto é zero.
    if (event.target.value === "0") {
        // Remove o produto se a quantidade for zero.
        event.target.parentElement.remove();
    }
    // Atualiza o valor total do carrinho.
    updateTotal();
}

// Função para finalizar a compra.
function finalizarCompra() {
    // Verifica se o valor total do carrinho é zero.
    if (totalAmount === "0,00") {
        // Alerta se o carrinho estiver vazio.
        alert("Seu carrinho está vazio!");
    } else {   
        // Agradece pela compra e mostra o valor do pedido.
        alert(
            `
            Obrigado pela sua compra!
            Valor do pedido: R$${totalAmount}\n
            Volte sempre :)
            `
        );

        // Limpa os itens do carrinho após a compra.
        document.querySelector(".cart-items").innerHTML = "";
        // Atualiza o valor total do carrinho.
        updateTotal();
        
        // Limpa o array do carrinho
        cart = [];
        // Remove o carrinho do localStorage
        localStorage.removeItem('cart');
    }
}

// Função para atualizar o valor total do carrinho.
function updateTotal() {
    // Seleciona todos os produtos no carrinho.
    const produtosDoCarrinho = document.getElementsByClassName("cart-product");
    let total = 0;

    if ( produtosDoCarrinho.length == 0 ) {
                // Limpa o array do carrinho
                cart = [];
                // Remove o carrinho do localStorage
                localStorage.removeItem('cart');
        
    }

    // Itera sobre cada produto no carrinho.
    for (let i = 0; i < produtosDoCarrinho.length; i++) {
        // Pega o preço do produto, removendo a formatação.
        const preçoProduto = produtosDoCarrinho[i].getElementsByClassName("cart-product-price")[0].innerText.replace("R$", "").replace(",", ".");
        // Pega a quantidade do produto.
        const quantidadeProduto = produtosDoCarrinho[i].getElementsByClassName("product-qtd-input")[0].value;
        // Calcula o total somando o preço multiplicado pela quantidade.
        total += preçoProduto * quantidadeProduto;
    }

    // Formata o total para duas casas decimais e substitui o ponto por vírgula.
    totalAmount = total.toFixed(2).replace(".", ",");
    // Atualiza o texto do total no HTML.
    document.querySelector(".carrinho-total span").innerText = "R$" + totalAmount;
}

// Função para alterar o preço de um produto no carrinho.
function alterarPrecoProduto(event) {
    // Solicita o novo preço ao usuário.
    const novoPreco = prompt("Digite o novo preço:");
    if (novoPreco) {
        // Formata o novo preço para o formato correto.
        const novoPrecoFormatado = "R$" + parseFloat(novoPreco).toFixed(2).replace(".", ",");
        // Atualiza o texto do preço no HTML.
        event.target.innerText = novoPrecoFormatado;
        // Atualiza o valor total do carrinho.
        updateTotal();
    }
}

// Função para mostrar um alerta ao tentar adicionar uma foto.
function showPhotoAlert() {
    // Mostra um alerta informando que o restaurante não adicionou uma foto.
    alert("O restaurante ainda não adicionou uma foto deste produto.");
}

document.getElementById("voltar").addEventListener('click', voltar);
function voltar() {
    window.location.href = '../Menu/menu.html';
}

// codigo base para esse carrinho de compras: https://github.com/gustavopolonio/Introducao-ao-Desenvolvimento-Web/blob/master/Como-programar-um-Carrinho-de-Compras_Tutorial-JavaScript/loja.js




/*
<script>
    // Função para adicionar item ao carrinho aaaaaaaaaaaa
    function addToCart(event) {
        const button = event.target;
        const productElement = button.closest('.menu-item');
        const productName = button.getAttribute('data-product');
        const productPrice = productElement.querySelector('span').innerText;

        // Obter o carrinho do localStorage ou criar um novo array
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Adicionar o novo produto ao carrinho
        cart.push({ name: productName, price: productPrice });

        // Salvar o carrinho atualizado no localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Feedback para o usuário
        alert(productName + " foi adicionado ao carrinho!");
    }

    // Selecionar todos os botões "Adicionar"
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    // Adicionar o evento de clique a cada botão
    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });

    // Função para redirecionar para a página do carrinho
    function goToCart() {
        window.location.href = 'cart.html';
    }
</script>
*/