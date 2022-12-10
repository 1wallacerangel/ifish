<?php

@include 'conexao.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:index.php');
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `usuario` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_usuarios.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>IFISH - Usuários</title>
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

   <section class="user-accounts">

      <h1 class="title">Contas de Usuários</h1>

      <div class="box-container">

         <?php
         $select_users = $conn->prepare("SELECT * FROM `usuario`");
         $select_users->execute();
         while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
         ?>
            <div class="box" style="<?php if ($fetch_users['id'] == $admin_id) {
                                       echo 'display:none';
                                    }; ?>">
               <p> User ID : <span><?= $fetch_users['id']; ?></span></p>
               <p> Nome : <span><?= $fetch_users['nome']; ?></span></p>
               <p> Email : <span><?= $fetch_users['email']; ?></span></p>
               <p> Tipo de Usuário : <span style=" color:<?php if ($fetch_users['user_type'] == 'admin') {
                                                      echo '#cc1825';
                                                   }; ?>"><?= $fetch_users['user_type']; ?></span></p>
               <a href="admin_usuarios.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('Deletar esse Usuário?');" class="delete-btn">deletar</a>
            </div>
         <?php
         }
         ?>
      </div>

   </section>

   <script src="js/script_admin.js"></script>

</body>

</html>