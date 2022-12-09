<?php 
ini_set('display_errors', 0 );
error_reporting(0);
?>
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
        $message_register[] = 'Email já cadastrado!';
    } else {
        if ($senha != $conf_senha) {
            $message_register[] = 'As senhas não batem!';
        } else {
            $insert = $conn->prepare("INSERT INTO `usuario`(nome, email, senha) VALUES(?,?,?)");
            $insert->execute([$nome, $email, $senha]);
            $message_register[] = 'Conta criada com sucessor!';
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

    if ($rowCount > 0) {

        if ($row['user_type'] == 'admin') {

            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_index.php');
        } elseif ($row['user_type'] == 'user') {

            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        } else {
            $message_login[] = 'Usuário não encontrado!';
        }
    } else {
        $message_login[] = 'Email ou senha incorretos!';
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
            if ($_SESSION) {
                $admin_id = $_SESSION['admin_id'];
                $select_profile = $conn->prepare("SELECT * FROM `usuario` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                echo '<p class="profile-nome">' . $fetch_profile['nome'] . '</p>
                    <a href="admin_atualizar_perfil.php" class="update-btn">Atualizar Perfil</a>
                    <a href="logout.php" class="logout-btn">sair<i class="fa-solid fa-right-from-bracket"></i></a>';
            } else {
                echo '
                <div id="btn"></div>
                <div class="button-box">
                    <button type="button" class="toggle-btn" onclick="login()" onclick="login2()">
                        <p class="log-text" id="log-p">Entrar</p>
                    </button>
                    <button type="button" class="toggle-btn" onclick="register()" onclick="register2()">
                        <p class="reg-text" id="reg-p">Cadastrar</p>
                    </button>
                </div>
                <form action="" id="login" class="login-form" method="POST">';

                if (isset($message_login)) {
                    foreach ($message_login as $message_login) {
                        echo '
                                <div class="mensagem-login">
                                <span>' . $message_login . '</span>
                                </div>
                            ';
                    }
                }
                echo '
                    <input type="email" name="email" placeholder="Insira seu email" class="box" required>
                    <input type="password" name="senha" placeholder="Insira sua senha" class="box2" id="senha-id" required>
                    <div id="eye" class="eye" onclick="eyeClick()"></div>
                    <p>Esqueceu sua senha? <a href="#">Clique Aqui</a></p>
                    <input type="submit" name="submit_login" value="Entrar" class="btn">
                </form>
                <form action="" method="POST" id="register" class="register-form">';

                if (isset($message_register)) {
                    foreach ($message_register as $message_register) {
                        echo '
                                <div class="mensagem-register">
                                <span>' . $message_register . '</span>
                                </div>
                            ';
                    }
                }
                echo '
                    <input type="text" name="nome" placeholder="Insira seu nome" class="box-r" required>
                    <input type="email" name="email" placeholder="Insira seu email" class="box-r" required>
                    <input type="password" name="senha" placeholder="Insira sua senha" class="box-r" required>
                    <input type="password" name="conf_senha" placeholder="Confirme sua senha" class="box-r" required>
                    <input type="submit" name="submit_register" value="Criar Conta" class="btn">
                    </form>';
            }
            ?>
        </div>
    </div>
</header>