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
   <title>IFISH - Pedidos</title>
   <link rel="shortcut icon" href="img/ifish-icon.png">
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/pedidos.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

</head>
<body class="body">
   
<?php include 'header.php'; ?>

<section class="pedidos">

   <h1 class="titulo">pedidos</h1>

   <div class="box-container-pedido">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `pedido` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <p> data do pedido : <span><?= $fetch_orders['data_pedido']; ?></span> </p>
      <p> nome : <span><?= $fetch_orders['nome']; ?></span> </p>
      <p> telefone : <span><?= $fetch_orders['telefone']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> endereço : <span><?= $fetch_orders['endereco']; ?></span> </p>
      <p> método de pagamento : <span><?= $fetch_orders['metodo']; ?></span> </p>
      <p> seu pedido : <span><?= $fetch_orders['total_produto']; ?></span> </p>
      <p> preço total : <span>R$ <?= $fetch_orders['total_preco']; ?></span> </p>
      <p> status de pagamento : <span style="color:<?php if($fetch_orders['status_pagamento'] == 'pendente'){ echo '#cc1825'; }else{ echo '#27ae60'; }; ?>"><?= $fetch_orders['status_pagamento']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">nenhum pedido disponível!</p>';
   }
   ?>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>