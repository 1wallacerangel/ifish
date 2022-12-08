<?php

@include 'conexao.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:index.php');
};

if (isset($_POST['add_product'])) {

    $nome = $_POST['name'];
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

    $select_products = $conn->prepare("SELECT * FROM `produto` WHERE nome = ?");
    $select_products->execute([$nome]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'product name already exist!';
    } else {

        $insert_products = $conn->prepare("INSERT INTO `produto`(nome, categoria, detalhe, preco, image) VALUES(?,?,?,?,?)");
        $insert_products->execute([$nome, $categoria, $detalhes, $preco, $image]);

        if ($insert_products) {
            if ($image_size > 2000000) {
                $message[] = 'image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'new product added!';
            }
        }
    }
};

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $select_delete_image = $conn->prepare("SELECT image FROM `produto` WHERE id = ?");
    $select_delete_image->execute([$delete_id]);
    $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    $delete_products = $conn->prepare("DELETE FROM `produto` WHERE id = ?");
    $delete_products->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `carrinho` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    header('location:admin_produtos.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFISH - Produtos</title>
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

    <section class="add-products">

        <h1 class="title">adicionar novos produtos</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="flex">
                <div class="inputBox">
                    <input type="text" name="name" class="box" required placeholder="Insira o nome do produto">
                    <select name="categoria" class="box" required>
                        <option value="" selected disabled>Selecione a Categoria</option>
                        <option value="peixes">Peixes</option>
                        <option value="crustáceos">Crustáceos</option>
                        <option value="moluscos">Moluscos</option>
                    </select>
                </div>
                <div class="inputBox">
                    <input type="number" min="0" name="preco" class="box" required placeholder="Insira o preço do produto">
                    <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
                </div>
            </div>
            <textarea name="detalhes" class="box" required placeholder="Insira os detalhes do produto" cols="30" rows="10"></textarea>
            <input type="submit" class="btn" value="Adicionar Produto" name="add_product">
        </form>

    </section>

    <section class="show-products">

        <h1 class="title">produtos adicionados</h1>

        <div class="box-container">

            <?php
            $show_products = $conn->prepare("SELECT * FROM `produto`");
            $show_products->execute();
            if ($show_products->rowCount() > 0) {
                while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <div class="price">R$<?= $fetch_products['preco']; ?></div>
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                        <div class="name"><?= $fetch_products['nome']; ?></div>
                        <div class="cat"><?= $fetch_products['categoria']; ?></div>
                        <div class="details"><?= $fetch_products['detalhe']; ?></div>
                        <div class="flex-btn">
                            <a href="admin_update_produtos.php?update=<?= $fetch_products['id']; ?>" class="option-btn">atualizar</a>
                            <a href="admin_produtos.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Deletar esse produto  ?');">deletar</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">nenhum produto foi adicionado!</p>';
            }
            ?>

        </div>

    </section>
    <script src="js/script_admin.js"></script>

</body>

</html>