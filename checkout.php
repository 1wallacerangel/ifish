<?php

@include 'conexao.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:index.php');
};

if (isset($_POST['order'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['flat'] . ' | ' . $_POST['street'] . ' | ' . $_POST['city'] . ' | ' . $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   date_default_timezone_set('America/Sao_Paulo');
   $placed_on = date('d-m-Y H:i', time());

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `carrinho` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if ($cart_query->rowCount() > 0) {
      while ($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
         $cart_products[] = $cart_item['nome'] . ' ( ' . $cart_item['quantidade'] . ' )';
         $sub_total = ($cart_item['preco'] * $cart_item['quantidade']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(' ',$cart_products);

   $order_query = $conn->prepare("SELECT * FROM `pedido` WHERE cpf = ? AND telefone = ? AND email = ? AND metodo = ? AND endereco = ? AND total_produto = ? AND total_preco = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if ($cart_total == 0) {
      $message[] = 'seu carrinho está vazio';
   } elseif ($order_query->rowCount() > 0) {
      $message[] = 'pedido feito!';
   } else {
      $insert_order = $conn->prepare("INSERT INTO `pedido`(user_id, cpf, telefone, email, metodo, endereco, total_produto, total_preco, data_pedido) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `carrinho` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'pedido efetuado com sucesso!';
   }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>IFISH - Finalizar Pedido</title>
   <link rel="shortcut icon" href="img/ifish-icon.png">
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/checkout.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

</head>

<body class="body">

   <?php include 'header.php'; ?>

   <section class="display-orders">

      <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `carrinho` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if ($select_cart_items->rowCount() > 0) {
         while ($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)) {
            $cart_total_price = ($fetch_cart_items['preco'] * $fetch_cart_items['quantidade']);
            $cart_grand_total += $cart_total_price;
      ?>
            <p> <?= $fetch_cart_items['nome']; ?> <span>(<?= 'R$ ' . $fetch_cart_items['preco'] . ' x ' . $fetch_cart_items['quantidade']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">seu carrinho está vazio!</p>';
      }
      ?>
      <div class="grand-total">valor total : <span>R$ <?= $cart_grand_total; ?></span></div>
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

   <section class="checkout-orders">

      <form action="" method="POST">

         <h3>finalize seu pedido</h3>

         <div class="flex">
            <div class="inputBox">
               <span>CPF :</span>
               <input type="number" name="name" placeholder="Ex: 000.000.000-00" class="box" required>
            </div>
            <div class="inputBox">
               <span>telefone :</span>
               <input type="number" name="number" placeholder="Ex: (22)999999999" class="box" required>
            </div>
            <div class="inputBox">
               <span> email :</span>
               <input type="email" name="email" placeholder="Ex: ifishcontato@gmail.com" class="box" required>
            </div>
            <div class="inputBox">
               <span>método de pagamento :</span>
               <select name="method" class="box" required>
                  <option value="Dinheiro">Dinheiro</option>
                  <option value="Cartão de Crédito">Cartão de Crédito/Débido</option>
                  <option value="Pix">Pix</option>
               </select>
            </div>
            <div class="inputBox">
               <span>endereço :</span>
               <input type="text" name="flat" placeholder="Ex: Rua..." class="box" required>
            </div>
            <div class="inputBox">
               <span>número :</span>
               <input type="number" name="street" placeholder="Ex: 555" class="box" required>
            </div>
            <div class="inputBox">
               <span>complemento :</span>
               <input type="text" name="city" placeholder="Ex: Apartamento..." class="box" required>
            </div>
            <div class="inputBox">
               <span>CEP :</span>
               <input type="number" min="0" name="pin_code" placeholder="Ex: 29999-000" class="box" required>
            </div>
         </div>

         <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1) ? '' : 'disabled'; ?>" value="finalizar">

      </form>

   </section>


   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>