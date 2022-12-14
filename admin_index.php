<?php 
ini_set('display_errors', 0 );
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <title>IFISH - Painel de Controle</title>
    <link rel="shortcut icon" href="img/ifish-icon.png">
    <link rel="stylesheet" href="css/admin_index.css">
    <link rel="stylesheet" href="css/admin_header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body class="body">
<div class="scroll">
    <?php include 'admin_header.php'; ?>

    <section class="dashboard">

        <h1 class="titulo">painel de controle</h1>

        <div class="box-container">

            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pendings = $conn->prepare("SELECT * FROM `pedido` WHERE status_pagamento = ?");
                $select_pendings->execute(['pendente']);
                while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                    $total_pendings += $fetch_pendings['total_preco'];
                };
                ?>
                <h3>R$ <?= $total_pendings; ?></h3>
                <p>Total Pendentes</p>
                <a href="admin_pedidos.php" class="btn-index">Veja os Pedidos</a>
            </div>

            <div class="box">
                <?php
                $total_completed = 0;
                $select_completed = $conn->prepare("SELECT * FROM `pedido` WHERE status_pagamento = ?");
                $select_completed->execute(['realizado']);
                while ($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)) {
                    $total_completed += $fetch_completed['total_preco'];
                };
                ?>
                <h3>R$ <?= $total_completed; ?></h3>
                <p>Total Finalizados</p>
                <a href="admin_pedidos.php" class="btn-index">Veja os Pedidos</a>
            </div>

            <div class="box">
                <?php
                $select_orders = $conn->prepare("SELECT * FROM `pedido`");
                $select_orders->execute();
                $number_of_orders = $select_orders->rowCount();
                ?>
                <h3><?= $number_of_orders; ?></h3>
                <p>Pedidos Realizados</p>
                <a href="admin_pedidos.php" class="btn-index">Veja os Pedidos</a>
            </div>

            <div class="box">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `produto`");
                $select_products->execute();
                $number_of_products = $select_products->rowCount();
                ?>
                <h3><?= $number_of_products; ?></h3>
                <p>Produtos Adicionados</p>
                <a href="admin_produtos.php" class="btn-index">Veja os Produtos</a>
            </div>

            <div class="box">
                <?php
                $select_users = $conn->prepare("SELECT * FROM `usuario` WHERE user_type = ?");
                $select_users->execute(['user']);
                $number_of_users = $select_users->rowCount();
                ?>
                <h3><?= $number_of_users; ?></h3>
                <p>Total Usu??rios</p>
                <a href="admin_usuarios.php" class="btn-index">Veja as Contas</a>
            </div>

            <div class="box">
                <?php
                $select_admins = $conn->prepare("SELECT * FROM `usuario` WHERE user_type = ?");
                $select_admins->execute(['admin']);
                $number_of_admins = $select_admins->rowCount();
                ?>
                <h3><?= $number_of_admins; ?></h3>
                <p>Total Admins</p>
                <a href="admin_usuarios.php" class="btn-index">Veja as Contas</a>
            </div>

            <div class="box">
                <?php
                $select_accounts = $conn->prepare("SELECT * FROM `usuario`");
                $select_accounts->execute();
                $number_of_accounts = $select_accounts->rowCount();
                ?>
                <h3><?= $number_of_accounts; ?></h3>
                <p>Total de Contas</p>
                <a href="admin_usuarios.php" class="btn-index">Veja as Contas</a>
            </div>

            <div class="box">
                <?php
                $select_messages = $conn->prepare("SELECT * FROM `mensagem`");
                $select_messages->execute();
                $number_of_messages = $select_messages->rowCount();
                ?>
                <h3><?= $number_of_messages; ?></h3>
                <p>Total de Mensagens</p>
                <a href="admin_contato.php" class="btn-index">Veja as Mensagens</a>
            </div>

        </div>

    </section>

    <script src="js/script_admin.js"></script>
</div>
</body>
</html>