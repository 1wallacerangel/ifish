<?php

@include 'conexao.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:index.php');
};

if (isset($_POST['update_pedido'])) {

   $pedido_id = $_POST['pedido_id'];
   $update_pagamento = $_POST['update_pagamento'];
   $update_pagamento = filter_var($update_pagamento, FILTER_SANITIZE_STRING);
   $update_pedidos = $conn->prepare("UPDATE `pedido` SET status_pagamento = ? WHERE id = ?");
   $update_pedidos->execute([$update_pagamento, $pedido_id]);
   $message[] = 'O Pagamento Foi Atualizado!';
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_pedidos = $conn->prepare("DELETE FROM `pedido` WHERE id = ?");
   $delete_pedidos->execute([$delete_id]);
   header('location:admin_pedidos.php');
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
   <link rel="stylesheet" href="css/admin_index.css">
   <link rel="stylesheet" href="css/admin-header.css">
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/admin_produtos.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

</head>

<body class="body">

   <?php include 'admin_header.php'; ?>

   <section class="placed-orders">

      <h1 class="title">pedidos</h1>

      <div class="box-container">

         <?php
         $select_orders = $conn->prepare("SELECT * FROM `pedido`");
         $select_orders->execute();
         if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> User ID : <span><?= $fetch_orders['user_id']; ?></span> </p>
                  <p> Data do Pedido : <span><?= $fetch_orders['data_pedido']; ?></span> </p>
                  <p> CPF : <span><?= $fetch_orders['cpf']; ?></span> </p>
                  <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
                  <p> Telefone : <span><?= $fetch_orders['telefone']; ?></span> </p>
                  <p> Endereço : <span><?= $fetch_orders['endereco']; ?></span> </p>
                  <p> Pedido : <span><?= $fetch_orders['total_produto']; ?></span> </p>
                  <p> Preço Total : <span>R$<?= $fetch_orders['total_preco']; ?></span> </p>
                  <p> Método de Pagamento : <span><?= $fetch_orders['metodo']; ?></span> </p>
                  <form action="" method="POST">
                     <input type="hidden" name="pedido_id" value="<?= $fetch_orders['id']; ?>">
                     <select name="update_pagamento" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['status_pagamento']; ?></option>
                        <option value="Pendente">Pendente</option>
                        <option value="Realizado">Realizado</option>
                     </select>
                     <div class="flex-btn">
                        <input type="submit" name="update_pedido" class="option-btn" value="Atualizar">
                        <a href="admin_pedidos.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Deletar esse pedido?');">Deletar</a>
                     </div>
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">nenhum pedido foi realizado!</p>';
         }
         ?>

      </div>

   </section>

   <script src="js/script_admin.js"></script>

</body>

</html>