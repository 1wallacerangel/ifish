<?php

include 'conexao.php';

if (isset($_POST['submit_register'])) {

    $nome = $_POST['nome'];
    $nome = filter_var($nome, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $senha = md5($_POST['senha']);
    $senha = filter_var($senha, FILTER_SANITIZE_STRING);
    $conf_senha = md5($_POST['conf_senha']);
    $conf_senha = filter_var($conf_senha, FILTER_SANITIZE_STRING);

    $select = $conn->prepare("SELECT * FROM `usuario` WHERE email = ?");
    $select->execute([$email]);

    if ($select->rowCount() > 0) {
        $message_register[] = 'user email already exist!';
    } else {
        if ($senha != $conf_senha) {
            $message_register[] = 'confirm password not matched!';
        } else {
            $insert = $conn->prepare("INSERT INTO `usuario`(nome, email, senha) VALUES(?,?,?)");
            $insert->execute([$nome, $email, $senha]);
            $message_register[] = 'registrado!';
        }
    }
}

?>

<?php

@include 'conexao.php';

session_start();

if (isset($_POST['submit_login'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $senha = md5($_POST['senha']);
    $senha = filter_var($senha, FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM `usuario` WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $senha]);
    $rowCount = $stmt->rowCount();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rowCount > 0){

        if($row['user_type'] == 'admin'){
  
           $_SESSION['admin_id'] = $row['id'];
           header('location:admin_index.php');
  
        }elseif($row['user_type'] == 'user'){
  
           $_SESSION['user_id'] = $row['id'];
           header('location:index.php');
  
        }else{
           $message[] = 'no user found!';
        }
  
    }else{
        $message[] = 'incorrect email or password!';
    }
}
?>

<?php

@include 'conexao.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `usuarios` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_users.php');
}
?>
<header class="header">
    <img href="index.php" class="ifish-bar" src="img/ifishlogo-red.png" ">
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
            if ($_SESSION) {
                $admin_id = $_SESSION['admin_id'];
                $select_profile = $conn->prepare("SELECT * FROM `usuario` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                echo '<p class="profile-name">' . $fetch_profile['nome'] . '</p>
                    <a href="logout.php" class="delete-btn">logout</a>';
            } else {
            }
            ?>
        </div>
        <div id="btn"></div>
        <div class="button-box">
            <button type="button" class="toggle-btn" onclick="login()" onclick="login2()">
                <p class="log-text" id="log-p">Logar</p>
            </button>
            <button type="button" class="toggle-btn" onclick="register()" onclick="register2()">
                <p class="reg-text" id="reg-p">Registrar</p>
            </button>
        </div>
        <form action="" id="login" class="login-form" method="POST">
            <?php
            if (isset($message_login)) {
                foreach ($message_login as $message_login) {
                    echo '
                        <div class="message">
                        <span>' . $message_login . '</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                        </div>
                    ';
                }
            }
            ?>
            <input type="email" name="email" placeholder="Insira seu email" class="box" required>
            <input type="password" name="senha" placeholder="Insira sua senha" class="box2" id="senha-id" required>
            <div id="eye" class="eye" onclick="eyeClick()"></div>
            <p>Esqueceu sua senha? <a href="#">Clique Aqui</a></p>
            <input type="submit" name="submit_login" value="logar" class="btn">
        </form>
        <form action="" method="POST" id="register" class="register-form">
            <?php
            if (isset($message_register)) {
                foreach ($message_register as $message_register) {
                    echo '
                        <div class="message">
                        <span>' . $message_register . '</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                        </div>
                    ';
                }
            }
            ?>
            <input type="text" name="nome" placeholder="Nome" class="box-r" required>
            <input type="email" name="email" placeholder="Insira seu email" class="box-r" required>
            <input type="password" name="senha" placeholder="Insira sua senha" class="box-r" required>
            <input type="password" name="conf_senha" placeholder="Confirme sua senha" class="box-r" required>
            <input type="submit" name="submit_register" value="register" class="btn">
        </form>
    </div>
</header>