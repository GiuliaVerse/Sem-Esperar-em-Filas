if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Renderiza os itens do carrinho
const renderCartItems = () => {
    const cartContainer = document.getElementById('cartContainer');
    cartContainer.innerHTML = '';

    if (cart.length === 0) {
        cartContainer.innerHTML = `
            <div class="empty-cart-message">
                <p>Seu carrinho está vazio.</p>
            </div>`;
        updateTotal();
        return;
    }

    cart.forEach((item, index) => {
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('cart-product');
        const price = parseFloat(item.price).toFixed(2);
        
        itemDiv.innerHTML = `
            <div class="product-details">
                <p class="cart-product-title">${item.name}</p>
                <p class="cart-product-price">R$ ${price}</p>
                <p class="cart-product-tempo">Tempo de Preparo: ${item.tempo} min</p>
            </div>
            <div class="quantity-control">
                <button class="decrement" onclick="changeQuantity(${index}, 'decrement')">-</button>
                <span class="product-qtd-input">${item.quantity}</span>
                <button class="increment" onclick="changeQuantity(${index}, 'increment')">+</button>
            </div>
            <button class="remove-product-button" onclick="removeProduct(${index})">Remover</button>
        `;
        cartContainer.appendChild(itemDiv);
    });

    updateTotal();
};

// Função para alterar a quantidade
function changeQuantity(productIndex, action) {
    if (cart[productIndex]) {
        if (action === 'increment') {
            cart[productIndex].quantity++; // Aumenta a quantidade
        } else if (action === 'decrement') {
            if (cart[productIndex].quantity > 1) {
                cart[productIndex].quantity--; // Diminui a quantidade
            } else {
                removeProduct(productIndex); // Remove o produto se a quantidade for 1
            }
        }
        updateLocalStorage(); // Atualiza o localStorage
        renderCartItems(); // Renderiza novamente
    } else {
        console.error('Produto não encontrado:', productIndex);
    }
}

// Função para remover um produto do carrinho
function removeProduct(productIndex) {
    cart.splice(productIndex, 1); // Remove o produto com o índice fornecido
    updateLocalStorage(); // Atualiza o localStorage
    renderCartItems(); // Renderiza os itens novamente
}

// Função para atualizar o localStorage
function updateLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Atualiza o valor total do carrinho
function updateTotal() {
    const total = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
    const totalAmount = total.toFixed(2).replace(".", ","); // Formata o total para o padrão brasileiro
    document.querySelector(".carrinho-total span").textContent = `R$ ${totalAmount}`;
}

// Função de finalizar compra
function finalizarCompra() {
    if (cart.length === 0) {
        alert("Seu carrinho está vazio!");
    } else {
        const total = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
        const totalAmount = total.toFixed(2).replace(".", ",");
        alert(`Obrigado pelo seu pedido!\nValor do pedido: R$${totalAmount}\nRedirecionando ... :)`);
        
        window.location.href = '../Pagamento/pagamento.html';
    }
}

// Configura listeners e inicializa o carrinho
function ready() {
    renderCartItems();
    document.getElementById("comprar").addEventListener("click", finalizarCompra);

    document.getElementById("voltar").addEventListener('click', () => {
        history.back();
    });
    document.getElementById('continuar-comprando-button').addEventListener('click', function() {
        history.back();
    });
}
