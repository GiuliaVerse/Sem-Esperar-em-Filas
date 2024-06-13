//  dados  do menu para cada restaurante


// Função para obter o nome do restaurante a partir da URL


// Função para renderizar o menu  do restaurante


//adicionar função para adicionar um item ao carrinho


// Quando a página for carregada, renderiza o menu do restaurante selecionado
document.addEventListener("DOMContentLoaded", () => {
    const restaurantName = getRestaurantNameFromURL();
    if (restaurantName) {
        renderMenu(restaurantName);
    } else {
        alert("Restaurante não encontrado!");
    }
});
