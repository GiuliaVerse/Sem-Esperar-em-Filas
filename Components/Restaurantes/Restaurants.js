document.addEventListener("DOMContentLoaded", () => {
  const restaurantList = document.getElementById("restaurantList");

  // Dados de exemplo (trocar por uma API)
  const restaurants = [
    {
      restaurantName: "Restaurant A",
      CNPJName: "CNPJ A",
      email: "emailA@example.com",
      cnpj: "12345678901234",
      telefone: "1234567890",
      endereco: "endereco A",
      instituicao: "instituicao A",
      culinariaType: "culinaria A",
    },
    {
      restaurantName: "Restaurant B",
      CNPJName: "CNPJ B",
      email: "emailB@example.com",
      cnpj: "98765432109876",
      telefone: "0987654321",
      endereco: "endereco B",
      instituicao: "instituicao B",
      culinariaType: "culinaria B",
    },
    {
      restaurantName: "Restaurant C",
      CNPJName: "CNPJ C",
      email: "emailC@example.com",
      cnpj: "12345678901234",
      telefone: "0987654321",
      endereco: "endereco C",
      instituicao: "instituicao C",
      culinariaType: "culinaria C",
    },
  ];

  let currentIndex = 0;

  // Função para renderizar os dados dos restaurantes
  const renderRestaurants = (restaurants) => {
    restaurantList.innerHTML = ""; // Limpa a lista anterior
    restaurants.forEach((restaurant) => {
      const restaurantItem = document.createElement("div");
      restaurantItem.classList.add("restaurant-item");

      restaurantItem.innerHTML = `
                    <h3>${restaurant.restaurantName}</h3>
                    <p><strong>CNPJ:</strong> ${restaurant.CNPJName}</p>
                    <p><strong>Email:</strong> ${restaurant.email}</p>
                    <p><strong>Telefone:</strong> ${restaurant.telefone}</p>
                    <p><strong>Endereço:</strong> ${restaurant.endereco}</p>
                    <p><strong>Instituição:</strong> ${restaurant.instituicao}</p>
                    <p><strong>Tipo de Cozinha:</strong> ${restaurant.culinariaType}</p>
                `;

      restaurantList.appendChild(restaurantItem);
    });
  };

  // Função para buscar restaurantes
  const searchRestaurants = () => {
    const searchInput = document
      .getElementById("searchInput")
      .value.toLowerCase();
    const filteredRestaurants = restaurants.filter((restaurant) =>
      restaurant.restaurantName.toLowerCase().includes(searchInput)
    );
    renderRestaurants(filteredRestaurants);
  };
});
var slideshows = document.querySelectorAll('[data-component="slideshow"]');
  
  // Aplica a todas as apresentações de slides que você define com o HTML escrito
  slideshows.forEach(initSlideShow);

  function initSlideShow(slideshow) {

    var slides = document.querySelectorAll(`#${slideshow.id} [role="list"] .slide`); // Obter um array de slides

    var index = 0, time = 5000;
    slides[index].classList.add('active');  
    
    setInterval( () => {
      slides[index].classList.remove('active');
      
      //Passar por cada slide, incrementando o índice
      index++;
      
      // Ao passar por todos os slides, reiniciar o índice para exibir o primeiro slide e iniciar novamente
      if (index === slides.length) index = 0; 
      
      slides[index].classList.add('active');

    }, time);
  }