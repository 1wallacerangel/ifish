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

if (isset($_POST['send'])) {

    $nome = $_POST['nome'];
    $nome = filter_var($nome, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $telefone = $_POST['telefone'];
    $telefone = filter_var($telefone, FILTER_SANITIZE_STRING);
    $mensagem = $_POST['mensagem'];
    $mensagem = filter_var($mensagem, FILTER_SANITIZE_STRING);

    $select_message = $conn->prepare("SELECT * FROM `mensagem` WHERE nome = ? AND email = ? AND telefone = ? AND mensagem = ?");
    $select_message->execute([$nome, $email, $telefone, $mensagem]);

    if ($select_message->rowCount() > 0) {
        $message[] = 'Essa Mensagem Já Foi Enviada!';
    } else {
        $insert_message = $conn->prepare("INSERT INTO `mensagem`(user_id, nome, email, telefone, mensagem) VALUES(?,?,?,?,?)");
        $insert_message->execute([$user_id, $nome, $email, $telefone, $mensagem]);
        $message[] = 'Mensagem Enviada com Sucesso!';
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
    <title>IFISH - Contato</title>
    <link rel="shortcut icon" href="img/ifish-icon.png">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/contato.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body class="body">
    <!--Barra de Navegação -->
    <?php include 'header.php'; ?>
    <section class="contato">
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
        <h1 class="titulo">contacte-nos</h1>
        <form action="" method="POST" class="contato-form">
            <input type="text" name="nome" class="box" required placeholder="Insira seu nome">
            <input type="email" name="email" class="box" required placeholder="Insira seu email">
            <input type="text" name="telefone" class="box" required placeholder="Insira seu número">
            <textarea name="mensagem" class="box" required placeholder="Escreva sua mensagem" cols="30" rows="10"></textarea>
            <input type="submit" value="Envie a mensagem" class="btn" name="send">
        </form>
    </section>
    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
    
</body>

</html>