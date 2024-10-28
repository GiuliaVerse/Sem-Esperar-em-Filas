const navbar = document.querySelector('.header .navbar'); // seleciona o elemento navbar
const menuBtn = document.querySelector('#menu-btn'); // seleciona o elemento menu-btn

menuBtn.onclick = () => {
    menuBtn.classList.toggle('fa-times');
    navbar.classList.toggle('active'); 
};// altera o icone do botão menu-btn