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

if (isset($_POST['atualizar-perfil'])) {

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $update_profile = $conn->prepare("UPDATE `usuario` SET email = ? WHERE id = ?");
   $update_profile->execute([$email, $user_id]);

   $senha_antiga = $_POST['senha_antiga'];
   $update_senha = md5($_POST['update_senha']);
   $update_senha = filter_var($update_senha, FILTER_SANITIZE_STRING);
   $new_senha = md5($_POST['new_senha']);
   $new_senha = filter_var($new_senha, FILTER_SANITIZE_STRING);
   $confirm_senha = md5($_POST['confirm_senha']);
   $confirm_senha = filter_var($confirm_senha, FILTER_SANITIZE_STRING);

   if (!empty($update_senha) and !empty($new_senha) and !empty($confirm_senha)) {
      if ($update_senha != $senha_antiga) {
         $message[] = 'A senha antiga não corresponde!';
      } elseif ($new_senha != $confirm_senha) {
         $message[] = 'As senhas não correspondem!';
      } else {
         $update_senha_query = $conn->prepare("UPDATE `usuario` SET senha = ? WHERE id = ?");
         $update_senha_query->execute([$confirm_senha, $user_id]);
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
   <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
   <meta name="apple-mobile-web-app-capable" content="yes"/>
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
               <input type="hidden" name="senha_antiga" value="<?= $fetch_profile['senha']; ?>">
               <span>Senha Antiga :</span>
               <input type="password" name="update_senha" placeholder="insira a antiga senha" class="box">
            </div>
            <div class="inputBox">
               <span>Nova Senha :</span>
               <input type="password" name="new_senha" placeholder="insira a nova senha" class="box">
               <span>Confirmar Senha :</span>
               <input type="password" name="confirm_senha" placeholder="confirme a nova senha" class="box">
            </div>
         </div>
         <div class="flex-btn">
            <input type="submit" class="btn-at" value="Atualizar Perfil" name="atualizar-perfil">
            <a onclick="javascript:history.go(-1)" class="option-btn">Voltar</a>
         </div>
      </form>

   </section>

   <?php include 'footer.php'; ?>


   <script src="js/script.js"></script>

</body>

</html>