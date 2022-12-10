<?php
ini_set('display_errors', 0);
error_reporting(0);
?>
<?php

include 'conexao.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:index.php');
};

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_users = $conn->prepare("DELETE FROM `usuarios` WHERE id = ?");
    $delete_users->execute([$delete_id]);
    header('location:admin_usuarios.php');
}
?>

<header class="header">
    <img href="index.php" class="ifish-bar-admin" src="img/ifishlogo-admin.png" ">
    <nav class=" navbar">
    <a href="admin_index.php">ínicio</a>
    <a href="admin_produtos.php">produtos</a>
    <a href="admin_pedidos.php">pedidos</a>
    <a href="admin_usuarios.php">usuários</a>
    <a href="admin_contato.php">mensagens</a>
    </nav>
    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-user" id="login-btn"></div>
    </div>
    <div class="icon">
        <div class="fa-solid fa-moon" id="moon"></div>
        <div class="fa-solid fa-sun" id="sun"></div>
    </div>
    <div class="log-register">
        <div class="profile">
            <?php
                $admin_id = $_SESSION['admin_id'];
                $select_profile = $conn->prepare("SELECT * FROM `usuario` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                echo '<p class="profile-nome">' . $fetch_profile['nome'] . '</p>
                <a href="admin_atualizar_perfil.php" class="update-btn">Atualizar Perfil</a>
                <a href="logout.php" class="logout-btn">sair<i class="fa-solid fa-right-from-bracket"></i></a>';
            ?>
        </div>
    </div>
</header>