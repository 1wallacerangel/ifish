<?php

@include 'conexao.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:index.php');
};

if (isset($_POST['update_order'])) {

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `pedido` SET status_pagamento = ? WHERE id = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'payment has been updated!';
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `pedido` WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:admin_pedidos.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   <title>IFISH</title>
   <link rel="shortcut icon" href="img/ifish-icon.png">
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/admin_index.css">
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/admin_produtos.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

</head>

<body class="body">

   <?php include 'admin_header.php'; ?>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

         <?php
         $select_orders = $conn->prepare("SELECT * FROM `pedido`");
         $select_orders->execute();
         if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
                  <p> placed on : <span><?= $fetch_orders['status_pagamento']; ?></span> </p>
                  <p> name : <span><?= $fetch_orders['nome']; ?></span> </p>
                  <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
                  <p> number : <span><?= $fetch_orders['telefone']; ?></span> </p>
                  <p> address : <span><?= $fetch_orders['endereco']; ?></span> </p>
                  <p> total products : <span><?= $fetch_orders['total_produto']; ?></span> </p>
                  <p> total price : <span>R$<?= $fetch_orders['total_preco']; ?></span> </p>
                  <p> payment method : <span><?= $fetch_orders['metodo']; ?></span> </p>
                  <form action="" method="POST">
                     <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                     <select name="update_payment" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['status_pagamento']; ?></option>
                        <option value="Pendente">Pedente</option>
                        <option value="Realizado">Realizado</option>
                     </select>
                     <div class="flex-btn">
                        <input type="submit" name="update_order" class="option-btn" value="udate">
                        <a href="admin_pedidos.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
                     </div>
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>

      </div>

   </section>

   <script src="js/script_admin.js"></script>

</body>

</html>