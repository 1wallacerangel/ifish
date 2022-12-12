<?php 
ini_set('display_errors', 0 );
error_reporting(0);
?>

<?php

@include 'conexao.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    
};

if (isset($_POST['categoria'])) {
    if (!isset($user_id)) {
        $message[] = 'Faça login !';
    }
}

if (isset($_POST['adicionar_carrinho'])) {
    if (!isset($user_id)) {
        $message[] = 'Faça login !';
    } else {

        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $nome = $_POST['nome'];
        $nome = filter_var($nome, FILTER_SANITIZE_STRING);
        $preco = $_POST['preco'];
        $preco = filter_var($preco, FILTER_SANITIZE_STRING);
        $image = $_POST['image'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $quantidade = $_POST['quantidade'];
        $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);

        $check_cart_numbers = $conn->prepare("SELECT * FROM `carrinho` WHERE nome = ? AND user_id = ?");
        $check_cart_numbers->execute([$nome, $user_id]);

        if ($check_cart_numbers->rowCount() > 0) {
            $message_carrinho[] = 'Já foi adicionado ao carrinho!';
        } else {
            $insert_cart = $conn->prepare("INSERT INTO `carrinho`(user_id, pid, nome, preco, quantidade,image) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $pid, $nome, $preco, $quantidade, $image]);
            $message_carrinho[] = 'Adicionado ao carrinho!';
        }
    }
};

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFISH</title>
    <link rel="shortcut icon" href="img/ifish-icon.png">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body class="body">

    <!--Barra de Navegação -->
    <?php include 'header.php'; ?>
    <!--início-->

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

    <div class="inicial-main">
        <div class="inicial-left">
            <div class="inicial-text">
                <h4 class="text-h4">Feito para você!</h4>
                <h1 class="text-h1">Tudo para Facilitar<br>Seu dia a dia</h1>
                <p class="p" onclick="login_popup()">Peça e receba onde estiver</p>
                <button id="faca-login" value="login"></button>
                <a href="sobre.php" class="inicial-btn">Sobre Nós</a>
            </div>
        </div>
        <div class="inicial-right">
            <section class="container">
                <div class="slides">
                    <input type="radio" name="radio" id="radio-1" checked>
                    <input type="radio" name="radio" id="radio-2">
                    <input type="radio" name="radio" id="radio-3">
                    <input type="radio" name="radio" id="radio-4">

                    <div class="imagens one">
                        <img src="img/slides/1_new.jpg" alt="imagens">
                    </div>
                    <div class="imagens">
                        <img src="img/slides/2_new.jpg" alt="imagens">
                    </div>
                    <div class="imagens">
                        <img src="img/slides/3_new.jpg" alt="imagens">
                    </div>
                    <div class="imagens">
                        <img src="img/slides/4_new.jpg" alt="imagens">
                    </div>
                </div>
                <div class="roll-slide">
                    <label for="radio-1" class="nav"></label>
                    <label for="radio-2" class="nav"></label>
                    <label for="radio-3" class="nav"></label>
                    <label for="radio-4" class="nav"></label>
                </div>
            </section>
        </div>
    </div>

    <section class="home-category">

        <h3 class="titulo">categorias</h3>

        <div class="box-container">

            <div class="box">
                <h3>peixes</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="categoria.php?categoria=peixes" class="btn">peixes</a>
            </div>

            <div class="box">
                <h3>crustáceos</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="categoria.php?categoria=crustáceos" class="btn">crustáceos</a>
            </div>

            <div class="box">
                <h3>moluscos</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="categoria.php?categoria=moluscos" class="btn">moluscos</a>
            </div>

        </div>

    </section>

    <section class="produtos">

        <h1 class="titulo">nossos produtos</h1>
        <?php
        if (isset($message_carrinho)) {
            foreach ($message_carrinho as $message_carrinho) {
                echo '
                <div class="mensagem">
                <span>' . $message_carrinho . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
                ';
            }
        }
        ?>

        <div class="box-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `produto`");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="card-produtos">
                        <form action="" class="box" method="POST">
                            <div class="preco">R$<span><?= $fetch_products['preco']; ?></span></div>
                            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                            <div class="nome"><?= $fetch_products['nome']; ?></div>
                            <div class="detalhes"><?= $fetch_products['detalhe']; ?></div>
                            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                            <input type="hidden" name="nome" value="<?= $fetch_products['nome']; ?>">
                            <input type="hidden" name="preco" value="<?= $fetch_products['preco']; ?>">
                            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                            <input type="hidden" value="1" name="quantidade">
                            <input type="submit" value="Adicionar" class="btn" name="adicionar_carrinho">
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty-produtos">nenhum produto disponível!</p>';
            }
            ?>

        </div>

    </section>

    <?php include 'footer.php'; ?>


    <script src="js/script.js"></script>
</body>

</html>