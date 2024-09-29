<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEF - Sem Esperar Em Filas</title>
  <meta name="title" content="SEF - Sem Esperar Em Filas">
  <meta name="description" content="PUCPR PROJETO PARA CANTINAS">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <iframe src="./Components/Header/NavBar/navBar.php" width="100%" height="100"></iframe>
  </header>
  
  <!-- Preloader -->
  <div class="loading-container" data-loading-container>
    <div class="loading-circle"></div>
  </div>

<!-- Navbar inserida -->
<!--object type="text/html" data="/Components/Header/NavBar/navBar.php" width="100%" height="100"></object-->

  <!-- Banner ''cansado ...'' -->
  <section class="section food has-bg-image" aria-label="home" style="background-image: url('./Components/Images/teste1.jpg')">
    <div class="container">
      <div class="navbar-banner">
        <h1 class="h1 food-title" style="color: white" >Cansado de esperar 10 minutos na fila para ficar sem coxinha?</h1>
        <a id="Peça Agora" href="menu.html" class="btn btn-secondary has-after">Peça Agora</a>  
      </div>
    </div>
  </section>

  <!-- Selecao de Restaurantes -->
  <section class="restaurant selection" aria-labelledby="selection-label">

    <div class="container">
      <h2 class="h2 section-title" id="selection-label" data-reveal>Suas cantinas preferidas aqui!</h2>
      <p class="section-text" data-reveal>
        Peça o que Quiser
        <br>
        No Momento que Quiser
      </p>
      <ul class="grid-list">
        <li data-reveal="left">
          <div class="selection-card">
            <figure class="card-banner">
              <img src="./Components/Images/hamburguer.png" width="300" height="154" loading="lazy" alt="Restaurant A"
                class="w-100">
            </figure>
            <div class="card-content">
              <h3 class="h5 card-title">
                Restaurante A
              </h3>
              <p class="card-text">
                Non enim praesent elementum facilisis leo vel fringilla. Lectus proin nibh nisl condimentum id. Quis
                varius quam quisque id diam vel.
              </p>
            </div>
          </div>
        </li>
        <li data-reveal>
          <div class="selection-card">
            <figure class="card-banner">
              <img src="./Components/Images/hamburguer.png" width="300" height="154" loading="lazy" alt="Restaurante B"
                class="w-100">
            </figure>
            <div class="card-content">
              <h3 class="h5 card-title">
                Restaurante B
              </h3>
              <p class="card-text">
                Eu mi bibendum neque egestas congue quisque. Nulla facilisi morbi tempus iaculis urna id volutpat
                lacus. Odio ut sem nulla pharetra diam sit amet.
              </p>
            </div>
          </div>
        </li>
        <li data-reveal="right">
          <div class="selection-card">
            <figure class="card-banner">
              <img src="./Components/Images/hamburguer.png" width="300" height="154" loading="lazy" alt="Restaurante C"
                class="w-100">
            </figure>
            <div class="card-content">
              <h3 class="h5 card-title">
                Restaurante C
              </h3>
              <p class="card-text">
                Nunc lobortis mattis aliquam faucibus. Nibh ipsum consequat nisl vel pretium lectus quam id leo. A
                scelerisque purus semper eget. Tincidunt arcu non.
              </p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>

  <!-- Cantinas CTA -->
  <section class="section cta has-bg-image cta-bg-image" aria-labelledby="cta-label"
    style="background-image: url('./Components/Images/garfo-faca.jpg')">
    <div class="container">
      <div class="cta-content">
        <h2 class="h3 section-title" id="cta-label">Você tem fome do quê?</h2>
        <p class="section-text">
          Faça seus pedidos sem esperar em filas e faça parte da nossa revolução!
        </p>
      </div>
    </div>
  </section>
  </main>
  <iframe src="./Components/Footer/footer.html" width="100%" height="100" title="Footer"></iframe>
  <script async src="script.js"></script>
</body>

</html>