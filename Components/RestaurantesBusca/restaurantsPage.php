<?php
    include('Restaurants.php');

	require('../../valida_sessao.php');
    if ($_SESSION["tipo"] != "cliente") {
        $url = "Location: /" . $url . "/index.php";
        header($url);
        exit();    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery - Busca de Restaurantes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="restaurantsPage.css">
</head>

<body>

<!-- restaurant section  -->

<div class="odd-section">

   <section class="restaurant" id="restaurant">

      <div class="heading">  
         <span>popular dishes</span>
         <h3>our delicious food</h3>
      </div>
   
      <div class="swiper restaurant-slider">
   
         <div class="swiper-wrapper">
   
            <div class="swiper-slide slide" data-name="restaurant-1">
                <img src="../../../Components/Images/hamburguer.png" alt="">
               <h3>delicious food</h3>
               <div class="price">$49.99</div>
            </div>
   
            <div class="swiper-slide slide" data-name="restaurant-2">
                <img src="../../../Components/Images/hamburguer.png" alt="">
               <h3>delicious food</h3>
               <div class="price">$49.99</div>
            </div>
   
            <div class="swiper-slide slide" data-name="restaurant-3">
                <img src="../../../Components/Images/hamburguer.png" alt="">
                <h3>delicious food</h3>
               <div class="price">$49.99</div>
            </div>
         </div>
   
         <div class="swiper-pagination"></div>
   
      </div>
   
   </section>

</div>

<!-- restaurant section termina -->

<!-- restaurant preview section comeca  -->

<section class="restaurant-preview-container">

   <div id="close-preview" class="fas fa-times"></div>

   <div class="restaurant-preview" data-target="restaurant-1">
      

      <h3>delicious food</h3>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
      </div>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, hic!</p>
      <div class="price">$49.99</div>
      <a href="#" class="btn">buy now</a>
   </div>

   <div class="restaurant-preview" data-target="restaurant-2">
        <img src="../../../Components/Images/hamburguer.png" alt="">
        <h3>delicious food</h3>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
      </div>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, hic!</p>
      <div class="price">$49.99</div>
      <a href="#" class="btn">buy now</a>
   </div>

   <div class="restaurant-preview" data-target="restaurant-3">
        <img src="../../../Components/Images/hamburguer.png" alt="">
      <h3>delicious food</h3>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
      </div>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, hic!</p>
      <div class="price">$49.99</div>
      <a href="#" class="btn">buy now</a>
   </div>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, hic!</p>
      <div class="price">$49.99</div>
      <a href="#" class="btn">buy now</a>
   </div>

</section>
<!-- food preview section termina -->


    <form>
        <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite o restaurante procurado" type="text" >
        <button type="submit"> Pesquisar Restaurante</button>
    </form>
    <br>
    <table width="600px" border="1">
        <tr>
            <th>Restaurante</th>
        </tr>
        
        <?php
        if (!isset($_GET['busca'])) {
            ?>
        <tr>
            <td colspan="1">Digite o restaurante para pesquisar</td>
        </tr>
        <?php
        } else {
            //Evita SQL injection com o real escape string no get busca
            $pesquisa = $mysqli ->real_escape_string($_GET['busca']);
            $sql_code = " SELECT * FROM restaurante WHERE nome_fantasia LIKE '%$pesquisa%' ";
            $sql_query = $mysqli ->query($sql_code) or die("Erro ao consultar! " . $mysqli ->error);

            if($sql_query -> num_rows == 0) {
        ?>
        <tr>
            <td colspan="1">Nenhum restaurante encontrado ...</td>
        </tr>
        <?php 
        } else {
            while($dados = $sql_query -> fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $dados['nome_fantasia']; ?> </td>
                </tr>
                <?php

            }
        }
        ?>

        <?php
        } ?>
        
    </table>

    <script src="Restaurants.js"></script>

    <footer>
        <iframe src="../Footer/footer.html" width="100%" height="100"></iframe>
    </footer>
</body>

</html>