<?php

@include 'conexao.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:index.php');
};

if (isset($_POST['update_produto'])) {

   $pid = $_POST['pid'];
   $nome = $_POST['nome'];
   $nome = filter_var($nome, FILTER_SANITIZE_STRING);
   $preco = $_POST['preco'];
   $preco = filter_var($preco, FILTER_SANITIZE_STRING);
   $categoria = $_POST['categoria'];
   $categoria = filter_var($categoria, FILTER_SANITIZE_STRING);
   $detalhes = $_POST['detalhes'];
   $detalhes = filter_var($detalhes, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;
   $old_image = $_POST['old_image'];

   $update_product = $conn->prepare("UPDATE `produto` SET nome = ?, categoria = ?, detalhe = ?, preco = ? WHERE id = ?");
   $update_product->execute([$nome, $categoria, $detalhes, $preco, $pid]);

   $message[] = 'Produto Atulizado com Sucesso!';

   if (!empty($image)) {
      if ($image_size > 2000000) {
         $message[] = 'Essa Imagem é Muito Grande!';
      } else {

         $update_image = $conn->prepare("UPDATE `produto` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);

         if ($update_image) {
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/' . $old_image);
            $message[] = 'Imagem Atulizada com Sucesso!';
         }
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
   <title>IFISH - Atualizar Produto</title>
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

   <section class="update-product">

      <h1 class="title">atualizar produto</h1>

      <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `produto` WHERE id = ?");
      $select_products->execute([$update_id]);
      if ($select_products->rowCount() > 0) {
         while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="" method="post" enctype="multipart/form-data">
               <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
               <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
               <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
               <input type="text" name="nome" placeholder="Insira o nome do produto" required class="box" value="<?= $fetch_products['nome']; ?>">
               <input type="number" name="preco" min="0" placeholder="Insira o preço do produto" required class="box" value="<?= $fetch_products['preco']; ?>">
               <select name="categoria" class="box" required>
                  <option value="" selected disabled>Selecione a Categoria</option>
                  <option value="peixes">Peixes</option>
                  <option value="crustáceos">Crustáceos</option>
                  <option value="moluscos">Moluscos</option>
               </select>
               <textarea name="detalhes" required placeholder="Insira os detalhes do produto" class="box" cols="30" rows="10"><?= $fetch_products['detalhe']; ?></textarea>
               <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
               <div class="flex-btn">
                  <input type="submit" class="btn" value="Atualizar Produto" name="update_produto">
                  <a href="admin_produtos.php" class="option-btn">Voltar</a>
               </div>
            </form>
      <?php
         }
      } else {
         echo '<p class="empty">no products found!</p>';
      }
      ?>

   </section>

   <script src="js/script.js"></script>

</body>

</html>