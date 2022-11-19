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
      $message[] = 'already added to cart!';
   } else {
      $insert_cart = $conn->prepare("INSERT INTO `carrinho`(user_id, pid, nome, preco, quantidade) VALUES(?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $nome, $preco, $quantidade]);
      $message[] = 'added to cart!';
   }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>IFISH</title>
   <link rel="shortcut icon" href="img/ifish-icon.png">
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/contato.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>

   <?php include 'header.php'; ?>

   <section class="p-category">

      <a href="category.php?category=fruits">fruits</a>
      <a href="category.php?category=vegitables">vegitables</a>
      <a href="category.php?category=fish">fish</a>
      <a href="category.php?category=meat">meat</a>

   </section>

   <section class="products">

      <h1 class="title">latest products</h1>

      <div class="box-container">
         <?php
         $select_products = $conn->prepare("SELECT * FROM `produtos`");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" class="box" method="POST">
                  <div class="price">$<span><?= $fetch_products['preco']; ?></span>/-</div>
                  <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <div class="name"><?= $fetch_products['nome']; ?></div>
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="nome" value="<?= $fetch_products['nome']; ?>">
                  <input type="hidden" name="preco" value="<?= $fetch_products['preco']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <input type="number" min="1" value="1" name="quantidade" class="qty">
                  <input type="submit" value="add to cart" class="btn" name="adicionar_carrinho">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

   </section>

   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>