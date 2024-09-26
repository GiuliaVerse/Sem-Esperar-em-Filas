// Aguarda o carregamento completo da página para iniciar a execução do código
document.addEventListener("DOMContentLoaded", () => {
  // Seleciona o elemento onde a lista de restaurantes será renderizada
  const restaurantList = document.getElementById("restauranteList");

  // Obtém o valor inserido no campo de busca de restaurante
  const dados = document.getElementById("buscaInput").value;

  // Variável que armazenará os dados dos restaurantes
  let restaurantes = [];

  // Faz uma requisição POST para o arquivo "Restaurants.php" com os dados de busca
  fetch("Restaurants.php", {
    method: "POST", // Método HTTP utilizado
    headers: {
      'Content-Type': 'application/json' // Define que os dados serão enviados no formato JSON
    },
    body: JSON.stringify({ // Converte os dados do campo de busca para JSON
      inputData: dados
    }),
  })
    .then((response) => response.json()) // Converte a resposta da requisição para JSON
    .then((dados) => {
        // Mapeia os dados recebidos do servidor para um formato adequado
        const restaurantes = dados.map((item) => ({
          restaurantName: item.nome_fantasia, // Nome do restaurante (campo 'nome_fantasia' do banco)
          culinariaType: "Teste", // Tipo de culinária (aqui é só um valor fictício de teste)
          rating: "4.5" // Nota de avaliação fictícia (também um valor de teste)
        }));
        // Chama a função que renderiza os restaurantes na tela
        renderRestaurantes(restaurantes);
      })
      .catch((error) => {
        // Exibe uma mensagem de erro no console se houver falha na requisição
        console.error("Erro:", error);
        alert("Ocorreu um erro ao enviar o formulário."); // Alerta em caso de erro
      });

  // Função para renderizar a lista de restaurantes na tela
  const renderRestaurantes = (restaurantes) => {
    restaurantList.innerHTML = ""; // Limpa a lista de restaurantes exibida
    // Para cada restaurante na lista fornecida
    restaurantes.forEach((restaurant) => {
      // Cria um novo elemento div para representar o restaurante
      const restaurantItem = document.createElement("div");
      // Adiciona a classe 'restaurant-item' ao div (para estilização)
      restaurantItem.classList.add("restaurant-item");

      // Define o conteúdo HTML do div com os dados do restaurante
      restaurantItem.innerHTML = `
              <h3>${restaurant.restaurantName}</h3>
              <button onclick="verMenu('${restaurant.restaurantName}')">Ver Menu</button> 
          `;
      // Adiciona o novo div ao elemento da lista de restaurantes na página
      restaurantList.appendChild(restaurantItem);
    });
  };

  // Função para filtrar a lista de restaurantes com base na busca do usuário
  const buscarRestaurantes = () => {
    // Obtém o valor digitado no campo de busca e converte para letras minúsculas
    const buscarInput = document.getElementById("buscarInput").value.toLowerCase();
    // Filtra a lista de restaurantes para incluir apenas os que correspondem ao texto de busca
    const filtrarRestaurantes = restaurantes.filter((restaurant) =>
      restaurant.restaurantName.toLowerCase().includes(buscarInput)
    );
    // Renderiza a lista filtrada de restaurantes
    renderRestaurantes(filtrarRestaurantes);
  };

  // Renderiza a lista inicial de restaurantes quando a página é carregada
  renderRestaurantes(restaurantes);

  // Torna a função buscarRestaurantes acessível no escopo global para ser chamada no HTML
  window.buscarRestaurantes = buscarRestaurantes;
});

// Função para redirecionar o usuário para a página do menu do restaurante
const verMenu = (restaurantName) => {
  // Redireciona para a página do menu, passando o nome do restaurante como parâmetro na URL
  window.location.href = `../Menu/menu.html?restaurant=${encodeURIComponent(restaurantName)}`;
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