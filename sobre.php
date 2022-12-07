<?php

@include 'conexao.php';

session_start();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <img src="img/ifish" alt="">
            <h3>quem somos?</h3>
            <p>Somos um grupo de estudantes do IFRJ Campus de Arraial do Cabo, nossa plataforma de delivery visa
            a praticidade nas vendas.
            Temos a proposta de atualizar o mercado de frutos do mar na cidade, começamos no 6° periodo como um trabalho de desenvolvimento web e decidimos trazer a proposta
            para o nosso TCC.</p>
            <a href="contato.php" class="btn">contacte-nos </a>
         </div>

         <div class="box">
            <img src="img/#" alt="">
            <h3>oque oferecemos?</h3>
            <p>Oferecemos um serviço de delivery frutos do mar voltado parar a região dos lagos, com um sistema de compra e venda. O vendedor divulga seus pedidos em nossa plataforma 
            e os usuarios realizam a compra pelo site. Visamos o conforto e a rapidez de um mercado que é muito presente em arraial do cabo e adjacências.</p>
            <a href="produtos.php" class="btn">nossos produtos</a>
         </div>

      </div>

   </section>

   <section class="desenvolvedores">

      <h1 class="titulo">desenvolvedores</h1>

      <div class="box-container">

         <div class="box">
            <img src="img/#" alt="">
            <h3>wallace rangel</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         </div>

         <div class="box">
            <img src="img/#" alt="">
            <h3>leonardo de oliveira</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
            Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         </div>

         <div class="box">
            <img src="img/#" alt="">
            <h3>luscas marques</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
            Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
            
         </div>

      </div>

   </section>

   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>