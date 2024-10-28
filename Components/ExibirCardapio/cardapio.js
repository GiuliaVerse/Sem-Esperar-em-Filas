const navbar = document.querySelector('.header .navbar'); // seleciona o elemento navbar
const menuBtn = document.querySelector('#menu-btn'); // seleciona o elemento menu-btn

menuBtn.onclick = () => {
    menuBtn.classList.toggle('fa-times');
    navbar.classList.toggle('active'); 
};// altera o icone do botão menu-btn
 
 
 // Seleciona todos os elementos com a classe 'content'
    document.querySelectorAll('.content').forEach(element => {
        element.addEventListener('click', () => {
            // Obtém o ID do cardápio diretamente do elemento
            const cardapioId = element.querySelector('.item-code').value;

            // Redireciona para a página de produtos
            window.location.href = `/Sem-Esperar-em-Filas/Components/ProdutosCardapio/produtos.php?cardapio_id=${cardapioId}`;
        });
    });

console.log(cardapioId);


