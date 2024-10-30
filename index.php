<?php include'Components/nav/nav.php';
$isLoggedIn = isset($_SESSION['login']) && $_SESSION['login'] === true;
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <link rel="icon" href="./Components/images/logoSef.png" type="image/png">
    <link rel="stylesheet" href="./style.css">
    <title>Home | SEF</title>
</head>
<body>

    <!-- home começa -->
    <section class="home" id="home">

        <!-- Carrosel de Imagens -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slide" style="background: url('Components/images/home-slide-1.jpg') no-repeat;">
                        <div class="content">
                            <span><?php echo $isLoggedIn ? 'buscando algo para comer' : 'buscando algo para comer?'; ?></span>
                            <h3><?php echo $isLoggedIn ? 'Veja nossas opções' : 'faça seu pedido'; ?></h3>
                            <a href="#" class="slide-btn" id="slide-btn" data-redirect="<?php echo $isLoggedIn ? '/Sem-Esperar-em-Filas/Components/Menu/menu.php' : '/Sem-Esperar-em-Filas/Components/LoginSelection/loginOption.html'; ?>">
                                <?php echo $isLoggedIn ? 'Ver Menu' : 'faça login para começar'; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide" style="background: url('Components/images/home-slide-2.jpg') no-repeat;">
                        <div class="content">
                            <span><?php echo $isLoggedIn ? 'ninguém aguenta esperar em filas!' : 'ninguém aguenta esperar em filas!'; ?></span>
                            <h3><?php echo $isLoggedIn ? 'não perca mais tempo' : 'não perca mais tempo'; ?></h3>
                            <a href="#" class="slide-btn" id="slide-btn-1" data-redirect="<?php echo $isLoggedIn ? '/Sem-Esperar-em-Filas/Components/Menu/menu.php' : '/Sem-Esperar-em-Filas/Components/LoginSelection/loginOption.html'; ?>">
                                <?php echo $isLoggedIn ? 'Ver Menu' : 'faça login para começar'; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide" style="background: url('Components/images/home-slide-3.jpg') no-repeat;">
                        <div class="content">
                            <span><?php echo $isLoggedIn ? 'facil de usar' : 'facil de usar'; ?></span>
                            <h3><?php echo $isLoggedIn ? 'peça sem sair da sala' : 'peça sem sair da sala'; ?></h3>
                            <a href="#" class="slide-btn" id="slide-btn-2" data-redirect="<?php echo $isLoggedIn ? '/Sem-Esperar-em-Filas/Components/Menu/menu.php' : '/Sem-Esperar-em-Filas/Components/LoginSelection/loginOption.html'; ?>">
                                <?php echo $isLoggedIn ? 'Ver Menu' : 'faça login para começar'; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Carrosel de Imagens termina -->

    </section>

    <!-- about section starts -->
     <section class="about" id="about">

        <div class="image">
            <img src="Components/images/about-image-0.jpg" alt="">
        </div>

        <div class="content">
            <h3 class="title">Sem Esperar em Filas</h3>
            <p>Bem-vindo ao Sem Esperar em Filas, sua solução prática para retirar pedidos na cantina da faculdade. 
                Facilite seu dia a dia e aproveite nossas opções de refeições e lanches, tudo sem sair do lugar. 
                Pedir nunca foi tão simples!</p>
            <a href="#" class="about-btn" id="about-btn">conheça nossa equipe</a>
            <div class="icons-container">
                <div class="icons">
                    <img src="Components/images/about-image-1.png" alt="">
                    <h3>comida de qualidade</h3>
                </div>
                <div class="icons">
                    <img src="Components/images/about-image-2.png" alt="">
                    <h3>sem perder tempo</h3>
                </div>
                <div class="icons">
                    <img src="Components/images/about-image-3.png" alt="">
                    <h3>chega de filas</h3>
                </div>
            </div>
        </div>

     </section>
     <!-- about section ends -->

     <!-- gallery sections starts -->
     <section class="gallery" id="gallery">

        <div class="heading">
            <span>Nossa galeria</span>
            <h3>diversas possibilidades</h3>
        </div>

        <div class="gallery-container">

            <a href="Components/images/food-gallery-1.jpg" class="box">
                <img src="Components/images/food-gallery-1.jpg" alt="">
                <div class="icon"><i class="fas fa-plus"></i></div>
            </a>

            <a href="Components/images/food-gallery-2.jpg" class="box">
                <img src="Components/images/food-gallery-2.jpg" alt="">
                <div class="icon"><i class="fas fa-plus"></i></div>
            </a>

            <a href="Components/images/food-gallery-3.jpg" class="box">
                <img src="Components/images/food-gallery-3.jpg" alt="">
                <div class="icon"><i class="fas fa-plus"></i></div>
            </a>

            <a href="Components/images/food-gallery-4.jpg" class="box">
                <img src="Components/images/food-gallery-4.jpg" alt="">
                <div class="icon"><i class="fas fa-plus"></i></div>
            </a>

            <a href="Components/images/food-gallery-5.jpg" class="box">
                <img src="Components/images/food-gallery-5.jpg" alt="">
                <div class="icon"><i class="fas fa-plus"></i></div>
            </a>

            <a href="Components/images/food-gallery-6.jpg" class="box">
                <img src="Components/images/food-gallery-6.jpg" alt="">
                <div class="icon"><i class="fas fa-plus"></i></div>
            </a>

        </div>

     </section>
     <!-- gallery sections ends -->

     <!-- blogs section starts -->
     <section class="blogs" id="blogs">

        <div class="heading">
            <span> recomendações </span>
            <h3> ultimas postagens </h3>
        </div>

        <div class="blogs-slider">

            <div class="slide">
                <div class="image">
                    <img src="Components/images/blog-img-1.jpg" alt="">
                    <span>sanduiche natural</span>
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"> <i class="fas fa-calendar"></i> 05/09/2024 </a>
                        <a href="#"> <i class="fas fa-user"></i> admin </a>
                    </div>
                    <a href="#" class="title">Sanduíche Natural - Leve e Delicioso</a>
                    <p>Uma opção saudável para quem busca sabor sem abrir mão da leveza. Feito com ingredientes frescos, é perfeito para uma refeição rápida e nutritiva.</p>
                    <a href="" class="blog-btn" id="blog-btn" > leia mais</a>
                </div>
            </div>
            

            <div class="slide">
                <div class="image">
                    <img src="Components/images/blog-img-2.jpg" alt="">
                    <span>panquecas</span>
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"> <i class="fas fa-calendar"></i> 05/09/2024 </a>
                        <a href="#"> <i class="fas fa-user"></i> admin </a>
                    </div>
                    <a href="#" class="title">Panquecas - Deliciosas e divertidas</a>
                    <p>Panquecas fofinhas e irresistíveis, servidas com mel, frutas frescas e uma pitada de canela. 
                        Uma escolha perfeita para quem deseja começar o dia com energia e muito sabor</p>
                    <a href="" class="blog-btn" id="blog-btn" > leia mais</a>
                </div>
            </div>
            

            <div class="slide">
                <div class="image">
                    <img src="Components/images/blog-img-3.jpg" alt="">
                    <span>hamburguer</span>
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"> <i class="fas fa-calendar"></i> 05/09/2024 </a>
                        <a href="#"> <i class="fas fa-user"></i> admin </a>
                    </div>
                    <a href="#" class="title">Hambúrguer - Clássico e Suculento</a>
                    <p>Um hambúrguer artesanal preparado com carne suculenta e ingredientes frescos, 
                        como alface crocante, tomate maduro e queijo derretido. Tudo isso servido no pão macio.</p>
                    <a href="" class="blog-btn" id="blog-btn"> leia mais</a>
                </div>
            </div>
            
            <div class="slide">
                <div class="image">
                    <img src="Components/images/blog-img-4.jpg" alt="">
                    <span>bolo de chocolate</span>
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"> <i class="fas fa-calendar"></i> 05/09/2024 </a>
                        <a href="#"> <i class="fas fa-user"></i> admin </a>
                    </div>
                    <a href="#" class="title">Bolo de Chocolate - da água na boca</a>
                    <p>Um bolo úmido e macio, preparado com chocolate de alta qualidade e coberto por uma camada generosa de ganache cremosa. Cada fatia traz o equilíbrio perfeito entre o doce e o amargo.</p>
                    <a href="" class="blog-btn" id="blog-btn"> leia mais</a>
                </div>
            </div>
            
            <div class="slide">
                <div class="image">
                    <img src="Components/images/blog-img-5.jpg" alt="">
                    <span>pizza</span>
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"> <i class="fas fa-calendar"></i> 05/09/2024 </a>
                        <a href="#"> <i class="fas fa-user"></i> admin </a>
                    </div>
                    <a href="#" class="title">Pizza - Tradição Italiana</a>
                    <p>pizza feita com massa fina e crocante, fermentada naturalmente e 
                        assada no forno à lenha para garantir aquele sabor inconfundível. 
                        Com uma seleção ingredientes frescos.</p>
                    <a href="" class="blog-btn" id="blog-btn"> leia mais</a>
                </div>
            </div>
            
            <div class="slide">
                <div class="image">
                    <img src="Components/images/blog-img-6.jpg" alt="">
                    <span>macarrão</span>
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"> <i class="fas fa-calendar"></i> 05/09/2024 </a>
                        <a href="#"> <i class="fas fa-user"></i> admin </a>
                    </div>
                    <a href="#" class="title">Macarrão com Molho - muito saboroso</a>
                    <p>Massa al dente servida com um molho rico e aromático, preparado com ingredientes frescos 
                        selecionados. Seja um clássico molho de tomate ou uma versão cremosa.</p>
                    <a href="#" class="blog-btn" id="blog-btn">leia mais</a>
                </div>
            </div>
            
        </div>

     </section>
      <!-- blogs section ends -->

      <!-- inicio do footer -->
        <div class="footer">

            <div class="icons-container">

                <div class="icons">
                    <i class="fas fa-clock"></i>
                    <h3>horario de funcionamento</h3>
                    <p>07:00 às 23:59</p>
                </div>
    
                <div class="icons">
                    <i class="fas fa-phone"></i>
                    <h3>telefone</h3>
                    <p>+123-456-789</p>
                    <p>+123-456-789</p>
                </div>
    
                <div class="icons">
                    <i class="fas fa-envelope"></i>
                    <h3>email</h3>
                    <p>sef@gmail.com</p>
                    <p>watermelonsef@gmail.com</p>
                </div>
    
                <div class="icons">
                    <i class="fas fa-tv"></i>
                    <h3>dispositivos</h3>
                    <p>disponível em vários dispositivos</p>
                </div>
    
            </div>
    
            <div class="share">
                <a href="https://www.linkedin.com/in/paulo-muchalski-0794652b9/" class="fab fa-linkedin"></a>
                <a href="https://www.instagram.com/paulocem_/" class="fab fa-instagram"></a>
                <a href="https://x.com/home" class="fab fa-x"></a>
                <a href="https://github.com/GiuliaVerse/Sem-Esperar-em-Filas" class="fab fa-github"></a>
            </div>
    
            <div class="credit">Created by <span> Watermelon Inc® </span> All rights reserved</div>
        </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
     <script src="./script.js"></script>
</body>
</html>