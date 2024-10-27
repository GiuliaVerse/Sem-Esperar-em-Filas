const userLoginBtn = document.getElementById('card-btn-user'); // Seleciona o botão de login do usuário
const restaurantLoginBtn = document.getElementById('card-btn-restaurant'); // Seleciona o botão de login do restaurante
const adminLoginBtn = document.getElementById('card-btn-admin'); // Seleciona o botão de login do administrador
userLoginBtn.onclick = () => {
    window.location.href = "/Sem-Esperar-em-Filas/Components/userLogin/login.html";
}// Redireciona para página de login do usuário

restaurantLoginBtn.onclick = () => {
    window.location.href = "/Sem-Esperar-em-Filas/Components/RestaurantLogin/restaurantLogin.html";
}// Redireciona para página de login do restaurante

adminLoginBtn.onclick = () => {
    window.location.href = "/Sem-Esperar-em-Filas/Components/Adminlogin/adminLogin.html";
}// Redireciona para página de login do administrador