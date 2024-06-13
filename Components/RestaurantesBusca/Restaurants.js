document.addEventListener("DOMContentLoaded", () => {
  const restaurantList = document.getElementById("restauranteList");

  // Seleciona o formulário
  const dados = document.getElementById("buscaInput").value;
  // Envia os dados usando a API Fetch
  restaurantes = [];

  fetch("Restaurants.php", {
    method: "POST",
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      inputData: dados
    }),
  })
    .then((response) => response.json())
    .then((dados) => {

        const restaurantes = dados.map((item) => ({
        restaurantName: item.nome_fantasia,
        culinariaType: "Teste",
        rating: "4.5"
    }));
    renderRestaurantes(restaurantes);
      })
      .catch((error) => {
            console.error("Erro:", error);
            alert("Ocorreu um erro ao enviar o formulário.");
      });  

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
              <button onclick="verMenu('${restaurant.restaurantName}')">Ver Menu</button> 
          `;
      // Adiciona o novo div ao elemento que representa a lista de restaurantes na tela
      restaurantList.appendChild(restaurantItem);
    });
  };

  const buscarRestaurantes = () => {
    // Obtém o valor digitado no campo de busca e converte para minúsculas
    const buscarInput = document
      .getElementById("buscarInput")
      .value.toLowerCase();
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

// Função para redirecionar para a página do menu
const verMenu = (restaurantName) => {
  window.location.href = `menu.html?restaurant=${encodeURIComponent(
    restaurantName
  )}`;
};

/*function RestauranteBusca() {
  var query = document.getElementById('buscaInput').value;
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'search.php?query=' + query, true);
  xhr.onload = function() {
      if (this.status == 200) {
          var restaurantes = JSON.parse(this.responseText);
          var output = '';
          for (var i in restaurantes) {
              output += '<p>' + restaurantes[i].name + '</p>';
          }
          document.getElementById('restauranteList').innerHTML = output;
      }
  };
  xhr.send();
}*/