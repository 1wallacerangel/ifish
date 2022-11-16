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
            <input type="text" name="name" class="box" required placeholder="Insira seu nome">
            <input type="email" name="email" class="box" required placeholder="Insira seu email">
            <input type="text" name="number" class="box" required placeholder="Insira seu número">
            <textarea name="msg" class="box" required placeholder="Escreva sua mensagem" cols="30" rows="10"></textarea>
            <input type="submit" value="Envie a mensagem" class="btn" name="send">
        </form>
    </section>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>