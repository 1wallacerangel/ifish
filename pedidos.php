<?php

@include 'conexao.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
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
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/pedidos.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

</head>
<body class="body">
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `ordens` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['nome']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['telefone']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['endereco']; ?></span> </p>
      <p> payment method : <span><?= $fetch_orders['metedo']; ?></span> </p>
      <p> your orders : <span><?= $fetch_orders['total_produtos']; ?></span> </p>
      <p> total price : <span>$<?= $fetch_orders['total_preco']; ?>/-</span> </p>
      <p> payment status : <span style="color:<?php if($fetch_orders['status_pagamento'] == 'pendente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['status_pagamento']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>