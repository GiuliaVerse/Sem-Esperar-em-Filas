if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}

let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Renderiza os itens do carrinho
const renderCartItems = () => {
  const cartContainer = document.getElementById("cartContainer");
  cartContainer.innerHTML = "";

  if (cart.length === 0) {
    cartContainer.innerHTML = `
                <div class="empty-cart-message">
                    <p>Seu carrinho está vazio.</p>
                </div>`;
    updateTotal();
    return;
  }

  cart.forEach((item, index) => {
    const itemDiv = document.createElement("div");
    itemDiv.classList.add("cart-product");
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
    if (action === "increment") {
      cart[productIndex].quantity++;
    } else if (action === "decrement") {
      if (cart[productIndex].quantity > 1) {
        cart[productIndex].quantity--;
      } else {
        removeProduct(productIndex);
      }
    }
    updateLocalStorage();
    renderCartItems();
  } else {
    console.error("Produto não encontrado:", productIndex);
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
  localStorage.setItem("cart", JSON.stringify(cart));
}

// Atualiza o valor total do carrinho
function updateTotal() {
  const total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
  const totalAmount = total.toFixed(2).replace(".", ","); // Formata o total para o padrão brasileiro
  document.querySelector(
    ".carrinho-total span"
  ).textContent = `R$ ${totalAmount}`;
}

function verificarItens() {
  if (cart.length === 0) {
    Swal.fire({
      icon: "warning",
      title: "Carrinho Vazio",
      text: "Seu carrinho está vazio!",
      confirmButtonText: "OK",
    });
  } else {
    openPaymentModal();
  }
}

// Função de abrir o modal de pagamento
function openPaymentModal() {
  const modal = document.getElementById("myModal");
  modal.style.display = "block";
}

// Função de fechar o modal
function closePaymentModal() {
  const modal = document.getElementById("myModal");
  modal.style.display = "none";
}

// Função para redirecionar para a página de pagamento
function redirectToPayment(option) {
  closePaymentModal();
  if (option === "cartao") {
    window.location.href = "../Pagamento/cartaoPage.php";
  } else if (option === "pix") {
    window.location.href = "../Pagamento/pagamentoPage.php";
  }
}

function ready() {
  renderCartItems();

  document.getElementById("comprar").addEventListener("click", verificarItens);
  document
    .getElementsByClassName("close")[0]
    .addEventListener("click", closePaymentModal);

  window.addEventListener("click", function (event) {
    const modal = document.getElementById("myModal");
    if (event.target === modal) {
      closePaymentModal();
    }
  });

  document
    .getElementById("pagamento-cartao")
    .addEventListener("click", function () {
      redirectToPayment("cartao");
    });

  document
    .getElementById("pagamento-pix")
    .addEventListener("click", function () {
      redirectToPayment("pix");
    });

  document.getElementById("voltar").addEventListener("click", () => {
    window.location.href = "../../Components/Menu/menu.php";
  });

  document
    .getElementById("continuar-comprando-button")
    .addEventListener("click", function () {
      history.back();
    });
}
