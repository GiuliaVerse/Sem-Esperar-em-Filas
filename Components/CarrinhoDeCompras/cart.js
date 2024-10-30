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

    cart.forEach((item) => {
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
                <button class="decrement" onclick="changeQuantity(${item.id}, 'decrement')">-</button>
                <span class="product-qtd-input">${item.quantity}</span>
                <button class="increment" onclick="changeQuantity(${item.id}, 'increment')">+</button>
            </div>
            <button class="remove-product-button" onclick="removeProduct(${item.id})">Remover</button>
        `;
        cartContainer.appendChild(itemDiv);
    });

    updateTotal();
};

// Função para adicionar um produto ao carrinho
function addProduct(id, name, price, tempo) {
    const existingProduct = cart.find(item => item.id === id);
    if (existingProduct) {
        existingProduct.quantity++; // Incrementa a quantidade se já existe
    } else {
        cart.push({ id, name, price, tempo, quantity: 1 }); // Adiciona um novo produto
    }
    localStorage.setItem('cart', JSON.stringify(cart)); // Salva no localStorage
    renderCartItems(); // Renderiza os itens do carrinho
}

// Função para alterar a quantidade
function changeQuantity(productId, action) {
    const product = cart.find(item => item.id === productId);
    if (product) {
        if (action === 'increment') {
            product.quantity++; // Aumenta a quantidade
        } else if (action === 'decrement') {
            if (product.quantity > 1) {
                product.quantity--; // Diminui a quantidade
            } else {
                removeProduct(productId); // Remove o produto se a quantidade for 1
            }
        }
        localStorage.setItem('cart', JSON.stringify(cart)); // Salva no localStorage
        renderCartItems(); // Renderiza novamente
    } else {
        console.error('Produto não encontrado:', productId);
    }
}

// Função para remover um produto do carrinho
function removeProduct(productId) {
    cart = cart.filter(item => item.id !== productId); // Remove o produto com o ID fornecido
    localStorage.setItem('cart', JSON.stringify(cart)); // Atualiza o localStorage
    renderCartItems(); // Renderiza os itens novamente
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

        cart = []; // Limpa o carrinho
        localStorage.removeItem('cart'); // Remove o carrinho do localStorage
        renderCartItems(); // Renderiza novamente para mostrar o carrinho vazio
        updateTotal(); // Atualiza o total

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
