const navbar = document.querySelector('.header .navbar'); // seleciona o elemento navbar
const menuBtn = document.querySelector('#menu-btn'); // seleciona o elemento menu-btn
const beginBtn = document.getElementById('slide-btn'); // seleciona o botão COMEÇAR do slide
const aboutBtn = document.getElementById('about-btn'); // Seleciona o botão "Conheça nossa equipe";
const blogsSection = document.querySelector('.blogs-slider'); // Seleciona a section pai dos botõs
let loggedUser; // captura o nome do usuário logado
let sessionName; // captura o nome da sessão


menuBtn.onclick = () => {
    menuBtn.classList.toggle('fa-times');
    navbar.classList.toggle('active'); 
};// altera o icone do botão menu-btn


beginBtn.onclick = () => { 
    window.location.href = "Components/Menu/menu.html"; // redireciona para a página dos restaurantes
}


aboutBtn.onclick = () => {
    window.location.href = "Components/AboutUs/about.html"; // redireciona para a página AboutUs
}


blogsSection.addEventListener('click', function(event) {
    // Verifica se o clique foi em um botão com a classe 'blog-btn'
    if (event.target.classList.contains('blog-btn')) {
        event.preventDefault(); // Previne o comportamento padrão do link
    }
});



lightGallery(document.querySelector('.gallery .gallery-container')); // manipula os slides da galeria


const addLoggedUserOnNavbar = function (session, user) {

    let userIcons = ['fas fa-user','fas fa-utensils']; // 0 - icone cliente | 1 - icone restaurante

    let newElement = document.createElement('a'); // cria um novo elemento <a>

    newElement.href='#'; // define o atributo href, ou seja, a pagina que será redirecionada

    let icon = document.createElement('i'); // cria um novo elemento <i>

    if(session == "restaurante"){ 

        let navbarLogin = document.getElementById('login-navbar'); // Seleciona a opção de login da navbar
        navbarLogin.remove(); // Remove a opção login da navbar
        
        icon.className = userIcons[1]; // define a classe do Font Awesome para o elemento <i>

        newElement.appendChild(icon); // adiciona o elemento do ícone como filho do elemento de link

        newElement.appendChild(document.createTextNode(` ${user}`)); // adiciona um espaço em branco e o nome do usuário ao link

        navbar.appendChild(newElement); // adiciona o novo elemento de link à navbar

        let products = document.createElement('a'); // cria um novo elemento <a>

        products.href = '#'; // define o atributo href, ou seja, a pagina que será redirecionada

        let productsIcon = document.createElement('i'); // cria um novo elemento <i>

        productsIcon.className = 'fas fa-burger'; // define a classe do Font Awesome para o elemento <i>

        products.appendChild(productsIcon); // adiciona o elemento do ícone como filho do elemento de link

        products.appendChild(document.createTextNode(' cadastrar produtos')); // adiciona um espaço em branco e o nome da nova opção

        navbar.appendChild(products); // adiciona o novo elemento de link à navbar

        
        let productsList = document.createElement('a'); // cria um novo elemento <a>

        productsList.href = '#'; // define o atributo href, ou seja, a pagina que será redirecionada

        let productsListIcon = document.createElement('i'); // cria um novo elemento <i>
        productsListIcon.className = 'fas fa-list'; // define a classe do Font Awesome para o elemento <i>

        productsList.appendChild(productsListIcon); // adiciona o elemento do ícone como filho do elemento de link

        productsList.appendChild(document.createTextNode(' lista de produtos')); // adiciona um espaço em branco e o nome da nova opção

        navbar.appendChild(productsList); // adiciona o novo elemento de link à navbar

        let logOut = document.createElement('a'); // cria um novo elemento <a>

        logOut.href = '#'; // define o atributo href, ou seja, a pagina que será redirecionada

        let logOutIcon = document.createElement('i'); // cria um novo elemento <i>
        logOutIcon.className = 'fas fa-arrow-right-from-bracket'; // define a classe do Font Awesome para o elemento <i>

        logOut.appendChild(logOutIcon); // adiciona o elemento do ícone como filho do elemento de link

        logOut.appendChild(document.createTextNode(' Sair')); // adiciona um espaço em branco e o nome da nova opção

        navbar.appendChild(logOut); // adiciona o novo elemento de link à navbar


    }

    else if(session == "user"){

        let navbarLogin = document.getElementById('login-navbar'); // Seleciona a opção de login da navbar
        navbarLogin.remove(); // Remove a opção login da navbar

        icon.className = userIcons[0]; // define a classe do Font Awesome para o elemento <i>

        newElement.appendChild(icon); // adiciona o elemento do ícone como filho do elemento de link

        newElement.appendChild(document.createTextNode(` ${user}`)); // adiciona um espaço em branco e o nome do usuário ao link

        navbar.appendChild(newElement); // adiciona o novo elemento de link à navbar

        let cart = document.createElement('a'); // define elemento do carrinho de compras
        cart.href = '#'; // define o atributo href, ou seja, a pagina que será redirecionada

        let cartIcon = document.createElement('i'); // cria um novo elemento <i>
        cartIcon.className = 'fas fa-cart-shopping'; // define a classe do Font Awesome para o elemento <i>

        cart.appendChild(cartIcon); // adiciona o elemento do ícone como filho do elemento de link

        cart.appendChild(document.createTextNode(' carrinho')); // adiciona um espaço em branco e o nome da nova opção

        navbar.appendChild(cart); // adiciona o novo elemento de link à navbar

        let logOut = document.createElement('a'); // cria um novo elemento <a>

        logOut.href = '#'; // define o atributo href, ou seja, a pagina que será redirecionada

        let logOutIcon = document.createElement('i'); // cria um novo elemento <i>
        logOutIcon.className = 'fas fa-arrow-right-from-bracket'; // define a classe do Font Awesome para o elemento <i>

        logOut.appendChild(logOutIcon); // adiciona o elemento do ícone como filho do elemento de link

        logOut.appendChild(document.createTextNode(' Sair')); // adiciona um espaço em branco e o nome da nova opção

        navbar.appendChild(logOut); // adiciona o novo elemento de link à navbar

    }
    
}

//teste
sessionName = "";
loggedUser = ""

addLoggedUserOnNavbar(sessionName,loggedUser);

