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

        // Recupera o carrinho atual do localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Verifica se o produto já está no carrinho
        let existingProduct = cart.find(product => product.name === productName);

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
        window.location.href = '../CarrinhoDeCompras/cart.html';
    });
});

