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

if (isset($_POST['update_profile'])) {

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $update_profile = $conn->prepare("UPDATE `usuario` SET email = ? WHERE id = ?");
   $update_profile->execute([$email, $user_id]);

   $old_pass = $_POST['old_pass'];
   $update_pass = md5($_POST['update_pass']);
   $update_pass = filter_var($update_pass, FILTER_SANITIZE_STRING);
   $new_pass = md5($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = md5($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if (!empty($update_pass) and !empty($new_pass) and !empty($confirm_pass)) {
      if ($update_pass != $old_pass) {
         $message[] = 'A senha antiga não corresponde!';
      } elseif ($new_pass != $confirm_pass) {
         $message[] = 'As senhas não correspondem!';
      } else {
         $update_pass_query = $conn->prepare("UPDATE `usuario` SET senha = ? WHERE id = ?");
         $update_pass_query->execute([$confirm_pass, $user_id]);
         $message[] = 'Senha atualizada com sucesso!';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>IFISH - Atulizar Perfil</title>
   <link rel="shortcut icon" href="img/ifish-icon.png">
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/usuario_atualizar_perfil.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body class="body">

   <?php include 'header.php'; ?>

   <section class="update-profile">

      <h1 class="titulo-profile">Atualizar Perfil</h1>

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

      <form action="" method="POST" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <span>Email :</span>
               <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" placeholder="atualizar email" required class="box">
               <input type="hidden" name="old_pass" value="<?= $fetch_profile['senha']; ?>">
               <span>Senha Antiga :</span>
               <input type="password" name="update_pass" placeholder="insira a antiga senha" class="box">
            </div>
            <div class="inputBox">
               <span>Nova Senha :</span>
               <input type="password" name="new_pass" placeholder="insira a nova senha" class="box">
               <span>Confirmar Senha :</span>
               <input type="password" name="confirm_pass" placeholder="confirme a nova senha" class="box">
            </div>
         </div>
         <div class="flex-btn">
            <input type="submit" class="btn-at" value="Atualizar Perfil" name="update_profile">
            <a href="index.php" class="option-btn">Voltar</a>
         </div>
      </form>

   </section>

   <?php include 'footer.php'; ?>


   <script src="js/script.js"></script>

</body>

</html>