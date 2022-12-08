   <?php

   @include 'conexao.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if (!isset($admin_id)) {
      header('location:index.php');
   };

   if (isset($_GET['delete'])) {

      $delete_id = $_GET['delete'];
      $delete_message = $conn->prepare("DELETE FROM `mensagem` WHERE id = ?");
      $delete_message->execute([$delete_id]);
      header('location:admin_mensagens.php');
   }

   ?>

   <!DOCTYPE html>
   <html lang="pt-BR">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>IFISH - Mensagens</title>
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

      <section class="messages">

         <h1 class="title">mensagens</h1>

         <div class="box-container">

            <?php
            $select_message = $conn->prepare("SELECT * FROM `mensagem`");
            $select_message->execute();
            if ($select_message->rowCount() > 0) {
               while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
            ?>
                  <div class="box">
                     <p> User ID : <span><?= $fetch_message['user_id']; ?></span> </p>
                     <p> Nome : <span><?= $fetch_message['nome']; ?></span> </p>
                     <p> Telefone : <span><?= $fetch_message['telefone']; ?></span> </p>
                     <p> Email : <span><?= $fetch_message['email']; ?></span> </p>
                     <p> Mensagem : <span><?= $fetch_message['mensagem']; ?></span> </p>
                     <a href="admin_contato.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">Deletar</a>
                  </div>
            <?php
               }
            } else {
               echo '<p class="empty">Nenhuma mensagem foi enviada!</p>';
            }
            ?>

         </div>

      </section>

      <script src="js/script_admin.js"></script>

   </body>

   </html>