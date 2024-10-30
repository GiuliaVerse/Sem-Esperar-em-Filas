const navbar = document.querySelector('.header .navbar'); // seleciona o elemento navbar
const menuBtn = document.querySelector('#menu-btn'); // seleciona o elemento menu-btn

menuBtn.onclick = () => {
    menuBtn.classList.toggle('fa-times');
    navbar.classList.toggle('active'); 
};// altera o icone do botão menu-btn

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const productName = this.getAttribute('data-product');
        const productPrice = parseFloat(this.getAttribute('data-price'));
        const productTempo = parseInt(this.getAttribute('data-tempo'));

        // Verifica se os dados necessários estão presentes e são válidos
        if (!productName || isNaN(productPrice) || isNaN(productTempo)) {
            console.error('Dados do produto inválidos:', { productName, productPrice, productTempo });
            alert("Não foi possível adicionar o produto ao carrinho. Tente novamente.");
            return; // Interrompe a execução se os dados forem inválidos
        }

        // Recupera o carrinho atual do localStorage e remove itens nulos
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart = cart.filter(item => item !== null && typeof item === 'object'); // Remove itens inválidos

        // Verifica se o produto já está no carrinho e se é válido
        let existingProduct = cart.find(product => product && product.name === productName);

        if (existingProduct) {
            // Se o produto já estiver no carrinho, aumenta a quantidade
            existingProduct.quantity += 1;
        } else {
            // Se o produto não estiver no carrinho, adiciona um novo produto com tempo de preparo
            cart.push({ name: productName, price: productPrice, quantity: 1, tempo: productTempo });
        }

        // Salva o carrinho atualizado no localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Exibe uma mensagem de confirmação
        alert(`${productName} foi adicionado ao carrinho!`);
        
        // Redireciona opcionalmente para a página do carrinho de compras
        window.location.href = '../CarrinhoDeCompras/cartPage.php';
    });
});


