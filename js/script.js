"use strict"; // Modo estrito para escrever JavaScript mais seguro e moderno  

const addEventOnElements = function (elem, type, callback) {
  for (let i = 0, len = elem.length; i < len; i++) {
    elem[i].addEventListener(type, callback);
  }
};
//addEventOnElements é usada para adicionar eventos de clique aos togglers de navegação e links da navbar.

const loadingElement = document.querySelector("[data-loading-container]");
// loading ElementAnimação de carregamento (Preloader)


window.addEventListener("load", function () {
  loadingElement.classList.add("loaded"); // Adiciona a classe 'loaded' ao elemento de carregamento
  document.body.classList.add("loaded");// Adiciona a classe 'loaded' ao body
});

const navbar = document.querySelector("[data-navbar]");
const navTogglers = document.querySelectorAll("[data-nav-toggler]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");
const overlay = document.querySelector("[data-overlay]");
//Faz a alternância da barra de navegação móvel

const toggleNavbar = function () {
  navbar.classList.toggle("active"); // Alterna a classe 'active' na navbar
  overlay.classList.toggle("active");// Alterna a classe 'active' no overlay
  document.body.classList.toggle("active");  // Alterna a classe 'active' no body
};
//toggleNavBar, as funções e seletores são usados para alternar a exibição da navbar móvel e do overlay.

addEventOnElements(navTogglers, "click", toggleNavbar);
//addEventOnElements adiciona evento de clique nos togglers da navbar

const closeNavbar = function () {
  navbar.classList.remove("active"); // Remove a classe 'active' da navbar
  overlay.classList.remove("active"); // Remove a classe 'active' do overlay
  document.body.classList.remove("active"); // Remove a classe 'active' do body
};

addEventOnElements(navbarLinks, "click", closeNavbar);
// Adiciona evento de clique nos links da navbar para fechar a navbar ao clicar em um link

const header = document.querySelector("[data-header]");
// Faz com que o  cabeçalho (Header) fique ativo após rolar 200px

const headerActive = function () {
  window.scrollY > 200
    ? header.classList.add("active")
    : header.classList.remove("active");
};
// Função para ativar o cabeçalho ao rolar a página por  200px

window.addEventListener("scroll", headerActive);
// Faz com que o evento de ''rolagem'' SEJA adicionado para ativar o header

const revealElements = document.querySelectorAll("[data-reveal]");
// Seleciona o [data-reveal] para criar aquele efeito de  revelação de elementos ao rolar a página (Scroll Reveal)

const scrollReveal = function () {
  for (let i = 0, len = revealElements.length; i < len; i++) {
    if (
      revealElements[i].getBoundingClientRect().top <
      window.innerHeight / 1.2
    ) {
      revealElements[i].classList.add("revealed");
    }
  }
};
//Função para revelar elementos ao rolar a página
window.addEventListener("scroll", scrollReveal);
window.addEventListener("load", scrollReveal);
window.addEventListener 
