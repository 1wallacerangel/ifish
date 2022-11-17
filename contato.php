<?php

@include 'conexao.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
};

if(isset($_POST['send'])){

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

    if($select_message->rowCount() > 0){
        $message[] = 'already sent message!';
    }else{
        $insert_message = $conn->prepare("INSERT INTO `mensagem`(user_id, nome, email, telefone, mensagem) VALUES(?,?,?,?,?)");
        $insert_message->execute([$user_id, $nome, $email, $telefone, $mensagem]);
        $message[] = 'sent message successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>IFISH</title>
    <link rel="shortcut icon" href="img/ifish-icon.png">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/contato.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body class="body">
    <!--Barra de Navegação -->
    <?php include 'header.php'; ?>
    <section class="contact">
        <h1 class="title">contacte-nos</h1>
        <form action="" method="POST" class="contact-form">
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