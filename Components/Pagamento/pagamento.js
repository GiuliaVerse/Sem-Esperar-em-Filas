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
                <p class="cart-product-title">${item.name}  ${item.quantity}x  R$ ${price}</p>
                <p class="cart-product-price"></p>
                <p class="cart-product-price"></p>
            </div>
        `;
        cartContainer.appendChild(itemDiv);
    });

    updateTotal();
};

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

function ready() {
    renderCartItems();
    
    // Evento de pagamento
    document.getElementById("pagar").addEventListener("click", () => {
        if (cart.length === 0) {
            alert("");
            return;
        }

        const elemento = document.getElementById("paid");
        elemento.style.zIndex = "1"; // Define o z-index para 1

        fetch('pagamento.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(cart) // Envia o carrinho em JSON
        })
        .then(response => response.json())
        .then(data => {
          console.log("Resposta do PHP:", data);
          if (data.success) {
            alert("Obrigado pela compra!");
            cart = []; // Esvazia a variável cart
            localStorage.removeItem('cart'); // Remove o item 'cart' do localStorage
            window.location.href = '/Sem-Esperar-em-Filas/index.php';
        
          } else {
            alert("Erro ao pagar!");
          }
        })
        .catch(error => {
          console.error("Erro:", error);
        });
    });

    document.getElementsByClassName("close")[0].addEventListener("click", closePaymentModal);

    window.addEventListener("click", function(event) {
        const modal = document.getElementById("myModal");
        if (event.target === modal) {
            closePaymentModal();
        }
    });
}
