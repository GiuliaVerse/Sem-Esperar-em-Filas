let cart = JSON.parse(localStorage.getItem('cart')) || {};

// Renderiza os itens do carrinho
const renderCartItems = () => {
    const cartContainer = document.getElementById('cartContainer');
    cartContainer.innerHTML = '';

    if (Object.keys(cart).length === 0) {
        cartContainer.innerHTML = `
            <div class="empty-cart-message">
                <p>Seu carrinho está vazio.</p>
            </div>`;
        updateTotal();
        return;
    }

    for (const productId in cart) {
        const item = cart[productId];
        
        // Verifica se o item é válido
        if (!item || typeof item.price !== 'number' || !item.name || typeof item.tempo !== 'number' || typeof item.quantity !== 'number') {
            console.error('Item inválido:', item);
            delete cart[productId]; // Remove item inválido
            continue; // Ignora este item se for inválido
        }

        const price = parseFloat(item.price).toFixed(2);
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('cart-product');
        itemDiv.innerHTML = `
            <div class="product-details">
                <p class="cart-product-title">${item.name}</p>
                <p class="cart-product-price">R$ ${price}</p>
                <p class="cart-product-tempo">Tempo de Preparo: ${item.tempo} min</p>
            </div>
            <div class="quantity-control">
                <button class="decrement" onclick="changeQuantity('${productId}', 'decrement')">-</button>
                <span class="product-qtd-input">${item.quantity}</span>
                <button class="increment" onclick="changeQuantity('${productId}', 'increment')">+</button>
            </div>
            <button class="remove-product-button" onclick="removeProduct('${productId}')">Remover</button>
        `;
        cartContainer.appendChild(itemDiv);
    }

    updateTotal();
};

// Função para adicionar um produto ao carrinho
function addProduct(id, name, price, tempo) {
    if (cart[id]) {
        cart[id].quantity++; // Incrementa a quantidade se já existe
    } else {
        // Verifica se os parâmetros estão corretos antes de adicionar
        if (name && typeof price === 'number' && typeof tempo === 'number') {
            cart[id] = { name, price, tempo, quantity: 1 }; // Adiciona um novo produto
        } else {
            console.error('Parâmetros inválidos para adicionar o produto:', { id, name, price, tempo });
            return; // Sai da função se os parâmetros não forem válidos
        }
    }
    updateLocalStorage(); // Atualiza o localStorage
    renderCartItems(); // Renderiza os itens do carrinho
}

// Função para alterar a quantidade
function changeQuantity(productId, action) {
    if (cart[productId]) {
        if (action === 'increment') {
            cart[productId].quantity++; // Aumenta a quantidade
        } else if (action === 'decrement') {
            if (cart[productId].quantity > 1) {
                cart[productId].quantity--; // Diminui a quantidade
            } else {
                removeProduct(productId); // Remove o produto se a quantidade for 1
            }
        }
        updateLocalStorage(); // Atualiza o localStorage
        renderCartItems(); // Renderiza novamente
    } else {
        console.error('Produto não encontrado:', productId);
    }
}

// Função para remover um produto do carrinho
function removeProduct(productId) {
    delete cart[productId]; // Remove o produto com o ID fornecido
    updateLocalStorage(); // Atualiza o localStorage
    renderCartItems(); // Renderiza os itens novamente
}

// Atualiza o valor total do carrinho
function updateTotal() {
    const total = Object.values(cart).reduce((acc, item) => {
        // Verifica se o item é válido antes de calcular o total
        if (item && item.price && item.quantity) {
            return acc + (item.price * item.quantity);
        }
        return acc; // Ignora itens inválidos
    }, 0);
    
    const totalAmount = total.toFixed(2).replace(".", ","); // Formata o total para o padrão brasileiro
    document.querySelector(".carrinho-total span").textContent = `R$ ${totalAmount}`;
}

// Atualiza o localStorage
function updateLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Função de finalizar compra (placeholder)
function finalizarCompra() {
    alert('Compra finalizada!'); // Substitua isso pela lógica de finalização da compra
}

// Configura listeners e inicializa o carrinho
function ready() {
    renderCartItems(); // Renderiza os itens do carrinho ao carregar
    document.getElementById("comprar").addEventListener("click", finalizarCompra);
    document.getElementById("voltar").addEventListener('click', () => {
        window.location.href = '../Menu/menu.html';
    });
    document.getElementById('continuar-comprando-button').addEventListener('click', function() {
        window.location.href = 'http://localhost/Sem-Esperar-em-Filas/Components/Menu/menu.php'; // URL do menu
    });
}

// Chamando a função de inicialização quando o documento estiver pronto
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}
