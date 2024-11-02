// Seleção de elementos da navbar
const navbar = document.querySelector('.header .navbar');
const menuBtn = document.querySelector('#menu-btn');

menuBtn.onclick = () => {
    menuBtn.classList.toggle('fa-times');
    navbar.classList.toggle('active'); 
};

// Função para obter o ID do usuário logado do localStorage
function getLoggedUserId() {
    const userId = localStorage.getItem('loggedUserId');
    if (!userId) {
        alert("Erro: Usuário não está logado.");
        return 'defaultUser'; // Retorna um valor padrão se o usuário não estiver logado
    }
    return userId;
}

// Adiciona eventos de clique para todos os botões "Adicionar ao carrinho"
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const productName = this.getAttribute('data-product');
        const productPrice = parseFloat(this.getAttribute('data-price').replace(',', '.'));
        const productTempo = parseInt(this.getAttribute('data-tempo'));

        // Verifica se os dados do produto são válidos
        if (!productName || isNaN(productPrice) || isNaN(productTempo)) {
            console.error('Dados do produto inválidos:', { productName, productPrice, productTempo });
            alert("Não foi possível adicionar o produto ao carrinho. Tente novamente.");
            return;
        }

        // Obter o ID do usuário logado e o carrinho específico do usuário
        const userId = getLoggedUserId();
        let cart = JSON.parse(localStorage.getItem(`cart_${userId}`)) || [];

        // Verifica se o produto já está no carrinho
        let existingProduct = cart.find(product => product && product.name === productName);

        if (existingProduct) {
            // Se o produto já estiver no carrinho, aumenta a quantidade
            existingProduct.quantity += 1;
        } else {
            // Se o produto não estiver no carrinho, adiciona um novo produto
            cart.push({ name: productName, price: productPrice, quantity: 1, tempo: productTempo });
        }

        // Salva o carrinho atualizado no localStorage usando o ID do usuário
        localStorage.setItem(`cart_${userId}`, JSON.stringify(cart));

        // Exibe uma mensagem de confirmação
        alert(`${productName} foi adicionado ao carrinho!`);

        // Opcional: redireciona para a página do carrinho de compras
        window.location.href = '../CarrinhoDeCompras/cartPage.php';
    });
});
