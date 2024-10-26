const userLoginBtn = document.getElementById('card-btn-user'); // Seleciona o botão de login do usuário
const userLoginBtn2 = document.getElementById('card-btn-user-register'); // Seleciona o botão de registro do usuário
const restaurantLoginBtn = document.getElementById('card-btn-restaurant'); // Seleciona o botão de login do restaurante
const restaurantLoginBtn2 = document.getElementById('card-btn-restaurant-register'); // Seleciona o botão de registro do restaurante

userLoginBtn.onclick = () => {
    window.location.href = "/Sem-Esperar-em-Filas/Components/userLogin/login.html";
}// Redireciona para página de login do usuário

userLoginBtn2.onclick = () => {
    window.location.href = "../userRegister/cadastro.html";
}// Redireciona para página de registro do usuário


restaurantLoginBtn.onclick = () => {
    window.location.href = "/Sem-Esperar-em-Filas/Components/RestaurantLogin/restaurantLogin.html";
}// Redireciona para página de login do restaurante
restaurantLoginBtn2.onclick = () => {
    window.location.href = "../RestaurantRegisterPage/restauranteRegister.html";
}// Redireciona para página de registro do restaurante