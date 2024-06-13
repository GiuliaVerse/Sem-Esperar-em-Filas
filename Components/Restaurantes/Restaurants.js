document.addEventListener("DOMContentLoaded", () => {
  const restaurantList = document.getElementById("restauranteList");


//trocar por uma api pro banco de dados
  const restaurantes = [
      {
          restaurantName: "Restaurante A",
          culinariaType: "Italiana",
          rating: 4.5,
      },
      {
          restaurantName: "Restaurante B",
          culinariaType: "Japonesa",
          rating: 4.0,
      },
      {
          restaurantName: "Restaurante C",
          culinariaType: "Brasileira",
          rating: 4.8,
      },
  ];
    // Função para renderizar a lista de restaurantes na tela
  const renderRestaurantes = (restaurantes) => {
      restaurantList.innerHTML = "";
          // Para cada restaurante na lista de restaurantes fornecida
      restaurantes.forEach((restaurant) => {
                // Cria um novo elemento div para representar o restaurante
          const restaurantItem = document.createElement("div");
                  // Adiciona a classe 'restaurant-item' ao novo div
          restaurantItem.classList.add("restaurant-item");
        
          // Define o conteúdo HTML do div com os dados do restaurante
          restaurantItem.innerHTML = `
              <h3>${restaurant.restaurantName}</h3>
              <p><strong>Tipo de Culinária:</strong> ${restaurant.culinariaType}</p>
              <p><strong>Avaliação:</strong> <span class="rating">${restaurant.rating} ★</span></p>
              <button onclick="verMenu('${restaurant.restaurantName}')">Ver Menu</button>

          `;
        // Adiciona o novo div ao elemento que representa a lista de restaurantes na tela
          restaurantList.appendChild(restaurantItem);
      });
  };

  const buscarRestaurantes = () => {
        // Obtém o valor digitado no campo de busca e converte para minúsculas
      const buscarInput = document.getElementById("buscarInput").value.toLowerCase();
          // Filtra a lista de restaurantes com base no valor de busca
      const filtrarRestaurantes = restaurantes.filter((restaurant) =>
          restaurant.restaurantName.toLowerCase().includes(buscarInput)
      );
          // Renderiza a lista de restaurantes filtrada na tela
      renderRestaurantes(filtrarRestaurantes);
  };
// Renderiza a lista inicial de restaurantes quando a página é carregada
  renderRestaurantes(restaurantes);

  // Torna a função buscarRestaurantes acessível no escopo global
  window.buscarRestaurantes = buscarRestaurantes;
});
