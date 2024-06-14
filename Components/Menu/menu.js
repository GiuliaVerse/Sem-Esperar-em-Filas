// Quando a página for carregada, renderiza o menu do restaurante selecionado
document.addEventListener("DOMContentLoaded", () => {
    const restaurantName = getRestaurantNameFromURL();
    if (restaurantName) {
        renderMenu(restaurantName);
    } else {
        alert("Restaurante não encontrado!");
    }
});

document.getElementById("Carrinho").addEventListener("click", function (event) {
    event.preventDefault(); // Evita o comportamento padrão do link
    window.location.href = "../CarrinhoDeCompras/cart.html"; // Redireciona para outra página
});


document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const productName = this.getAttribute('data-product');
        const productPrice = parseFloat(this.getAttribute('data-price'));

        // Recupera o carrinho atual do localStorage (como fazer?? exemplo:)
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // exemplo v    erifica se o produto já está no carrinho
        let existingProduct = cart.find(product => product.name === productName);

        if (existingProduct) {
            // Se o produto já estiver no carrinho, aumenta a quantidade
            existingProduct.quantity += 1;
        } else {
            // Se o produto não estiver no carrinho, adiciona um novo produto
            cart.push({ name: productName, price: productPrice, quantity: 1 });
        }

        // Salva o carrinho atualizado no localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Exibe uma mensagem de confirmação
        alert(`${productName} foi adicionado ao carrinho!`);
    });
});
