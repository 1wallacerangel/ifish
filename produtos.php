<?php 
ini_set('display_errors', 0 );
error_reporting(0);
?>

<?php

@include 'conexao.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:index.php');
};

if (isset($_POST['adicionar_carrinho'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $nome = $_POST['nome'];
   $nome = filter_var($nome, FILTER_SANITIZE_STRING);
   $preco = $_POST['preco'];
   $preco = filter_var($preco, FILTER_SANITIZE_STRING);
   $image = $_POST['image'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $quantidade = $_POST['quantidade'];
   $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `carrinho` WHERE nome = ? AND user_id = ?");
   $check_cart_numbers->execute([$nome, $user_id]);

   if ($check_cart_numbers->rowCount() > 0) {
      $message[] = 'Já foi adicionado ao carrinho!';
   } else {
      $insert_cart = $conn->prepare("INSERT INTO `carrinho`(user_id, pid, nome, preco, quantidade,image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $nome, $preco, $quantidade, $image]);
      $message[] = 'Adicionado ao carrinho!';
   }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
   <meta name="apple-mobile-web-app-capable" content="yes"/>
   <title>IFISH - Produtos</title>
   <link rel="shortcut icon" href="img/ifish-icon.png">
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/produtos.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body class="body">

   <?php include 'header.php'; ?>

   <section class="p-category">

      <a href="categoria.php?categoria=peixes">peixes</a>
      <a href="categoria.php?categoria=crustáceos">crustáceos</a>
      <a href="categoria.php?categoria=moluscos">moluscos</a>

   </section>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
            <div class="mensagem">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
      }
   }
   ?>

   <section class="produtos">

      <h1 class="titulo">produtos</h1>

      <div class="box-container">
         <?php
         $select_products = $conn->prepare("SELECT * FROM `produto`");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="card-produtos">
                  <form action="" class="box" method="POST">
                     <div class="preco">R$<span><?= $fetch_products['preco']; ?></span></div>
                     <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                     <div class="nome"><?= $fetch_products['nome']; ?></div>
                     <div class="detalhes"><?= $fetch_products['detalhe']; ?></div>
                     <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                     <input type="hidden" name="nome" value="<?= $fetch_products['nome']; ?>">
                     <input type="hidden" name="preco" value="<?= $fetch_products['preco']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                     <input type="hidden" value="1" name="quantidade">
                     <input type="submit" value="Adicionar" class="btn" name="adicionar_carrinho">
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty-produtos">nenhum produto disponível!</p>';
         }
         ?>

      </div>

   </section>

   <?php include 'footer.php'; ?>


   <script src="js/script.js"></script>

</body>

</html>