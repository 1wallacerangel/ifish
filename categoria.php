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

if (isset($_POST['add_carrinho'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `carrinho` WHERE nome = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($check_cart_numbers->rowCount() > 0) {
      $message[] = 'Já foi adicionado ao carrinho!';
   } else {
      $insert_cart = $conn->prepare("INSERT INTO `carrinho`(user_id, pid, nome, preco, quantidade, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'Adicionado ao carrinho!';
   }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>IFISH - Categoria</title>
   <link rel="shortcut icon" href="img/ifish-icon.png">
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/categoria.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

</head>

<body class="body">

   <?php include 'header.php'; ?>

   <section class="produtos">
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
      <h1 class="titulo-cat"><?= $category_name = $_GET['categoria']; ?></h1>

      <div class="box-container">

         <?php
         $category_name = $_GET['categoria'];
         $select_products = $conn->prepare("SELECT * FROM `produto` WHERE categoria = ?");
         $select_products->execute([$category_name]);
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
                     <input type="hidden" name="p_name" value="<?= $fetch_products['nome']; ?>">
                     <input type="hidden" name="p_price" value="<?= $fetch_products['preco']; ?>">
                     <input type="hidden" value="1" name="quantidade">
                     <input type="submit" value="Adicionar" class="btn" name="add_carrinho">
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