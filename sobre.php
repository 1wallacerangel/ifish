<?php 
ini_set('display_errors', 0 );
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
   <meta name="apple-mobile-web-app-capable" content="yes"/>
   <title>IFISH - Sobre</title>
   <link rel="shortcut icon" href="img/ifish-icon.png">
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/sobre.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body class="body">

   <?php include 'header.php'; ?>

   <section class="sobre">

      <div class="row">

         <div class="box">
            <img src="img/#" alt="">
            <h3>quem somos?</h3>
            <p>Somos um grupo de desenvolvedores, que vimos a necessidade no mercado regional em fornecer um serviço que auxilie os vendedores e consumidores de frutos-do-mar, oferecendo-os  mais praticidade e conforto.</p>
            <a href="contato.php" class="btn">contacte-nos </a>
         </div>

         <div class="box">
            <img src="img/#" alt="">
            <h3>oque oferecemos?</h3>
            <p>Oferecemos um serviço de delivery frutos do mar voltado parar a região dos lagos, com um sistema de compra e venda. O vendedor divulga seus pedidos em nossa plataforma 
            e os usuarios realizam a compra pelo site.</p>
            <a href="produtos.php" class="btn">nossos produtos</a>
         </div>

      </div>

   </section>

   <section class="desenvolvedores">

      <h1 class="titulo">desenvolvedores</h1>

      <div class="box-container">

         <div class="box">
            <img src="img/walla.jpg" alt="">
            <h3>wallace rangel</h3>
         </div>

         <div class="box">
            <img src="img/leo.jpg" alt="">
            <h3>leonardo de oliveira</h3>
         </div>

         <div class="box">
            <img src="img/lusca.jpg" alt="">
            <h3>lucas marques</h3>
         </div>

      </div>

   </section>

   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>