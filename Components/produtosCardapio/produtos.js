document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const productName = this.getAttribute('data-product');
        const productPrice = parseFloat(this.getAttribute('data-price'));
        const productTempo = parseInt(this.getAttribute('data-tempo'));

        // Verifica se os atributos estão definidos
        if (!productName || isNaN(productPrice) || isNaN(productTempo)) {
            console.error('Produto inválido. Verifique os atributos.');
            return; // Sai da função se os atributos forem inválidos
        }

        // Recupera o carrinho atual do localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        console.log('Conteúdo do carrinho:', cart);

        // Verifica se o produto já está no carrinho
        let existingProduct = cart.find(product => product && product.name === productName);
        console.log('Produto existente:', existingProduct);

        if (existingProduct) {
            // Se o produto já estiver no carrinho, aumenta a quantidade
            existingProduct.quantity += 1;
        } else {
            // Se o produto não estiver no carrinho, adiciona um novo produto
            cart.push({ name: productName, price: productPrice, quantity: 1, tempo: productTempo });
        }

        // Salva o carrinho atualizado no localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Exibe uma mensagem de confirmação
        alert(`${productName} foi adicionado ao carrinho!`);
    });
});