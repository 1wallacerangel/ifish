<?php 
ini_set('display_errors', 0 );
error_reporting(0);
?>
<?php

include 'conexao.php';

if (isset($_POST['cadastro'])) {

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
        $message_register[] = 'Email já Cadastrado!';
    } else {
        if ($senha != $conf_senha) {
            $message_register[] = 'As Senhas não Batem!';
        } else {
            $insert = $conn->prepare("INSERT INTO `usuario`(nome, email, senha) VALUES(?,?,?)");
            $insert->execute([$nome, $email, $senha]);
            $message_register[] = 'Conta Criada com Sucesso!';
        }
    }
}

?>

<?php

@include 'conexao.php';

session_start();

if (isset($_POST['entrar'])) {

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
            $message_login[] = 'Usuário não Encontrado!';
        }
    } else {
        $message_login[] = 'Email ou Senha incorretos!';
    }
}
?>

<?php

@include 'conexao.php';

session_start();

$user_id = $_SESSION['user_id'];

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_cart_item = $conn->prepare("DELETE FROM `carrinho` WHERE id = ?");
    $delete_cart_item->execute([$delete_id]);
    header('location:produtos.php');
}

if (isset($_GET['delete_all'])) {
    $delete_cart_item = $conn->prepare("DELETE FROM `carrinho` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    header('location:produtos.php');
}

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $p_qty = $_POST['p_qty'];
    $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);
    $update_qty = $conn->prepare("UPDATE `carrinho` SET quantidade = ? WHERE id = ?");
    $update_qty->execute([$p_qty, $cart_id]);
    $message[] = 'Quantidade do Produto Atulizada!';
}

?>


<header class="header">
    <img href="index.php" class="ifish-bar" src="img/ifishlogo-red.png" ">
    <nav class=" navbar">
    <a href="index.php">ínicio</a>
    <a href="produtos.php">produtos</a>
    <a href="pedidos.php">pedidos</a>
    <a href="sobre.php">sobre</a>
    <a href="contato.php">contato</a>
    </nav>
    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-search" id="search-btn"></div>
        <div class="fas fa-shopping-cart" id="cart-btn"></div>
        <div class="fas fa-user" id="login-btn"></div>
    </div>
    <div class="icon">
        <div class="fa-solid fa-moon" id="moon"></div>
        <div class="fa-solid fa-sun" id="sun"></div>
    </div>
        <form action="buscar.php" method="POST" class="search-form">
            <input type="search" name="search_box" id="search-box" placeholder="Busque por um produto">
            <button type="submit" name="search_btn" class="fas fa-search"></button>
        </form>

    <div class="shopping-cart">
        <section class="shopping-car">
            <div class="box-container">

                <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `carrinho` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <form action="" method="POST" class="box">
                            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                            <img id="cart-img" src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                            <div class="nome">
                                <?= $fetch_cart['nome']; ?>
                                <div class="sub-total"><span>R$ <?= $sub_total = ($fetch_cart['preco'] * $fetch_cart['quantidade']); ?></span> </div>

                            </div>

                            <div class="flex-btn">
                                <input type="number" min="1" value="<?= $fetch_cart['quantidade']; ?>" class="qty" name="p_qty">
                                <input type="submit" value="atualizar" name="update_qty" class="option-btn">
                            </div>
                            <a href="index.php?delete=<?= $fetch_cart['id']; ?>" class="fas fa-trash" onclick="return confirm('Esse produto será removido do carrinho!');"></a>

                        </form>

                <?php
                        $grand_total += $sub_total;
                    }
                } else {
                }
                ?>

                <?php
                if ($select_cart->rowCount() > 0) {

                ?>
                    <div class="cart-total">
                        <p class="total">total : <span>R$ <?= $grand_total; ?></span></p>
                        <div class="total-btn">
                            <a href="produtos.php" class="continue-btn">continue comprando</a>
                            <a href="produtos.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">remover todos</a>
                        </div>
                        <a href="finalizar.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">finalizar pedido</a>
                    </div>
                <?php
                } else {
                    echo '<p class="empty-carrinho">seu carrinho está vazio!</p>
                    <div class="cart-total">
                        <div class="total-btn">
                            <a href="produtos.php" class="continue-btn-vazio">continue comprando</a>                        
                        </div>                      
                    </div>';
                }
                ?>

            </div>
        </section>
    </div>
    <div class="log-register">
        <div class="profile">
            <?php
            if ($_SESSION) {
                $user_id = $_SESSION['user_id'];
                $select_profile = $conn->prepare("SELECT * FROM `usuario` WHERE id = ?");
                $select_profile->execute([$user_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                echo '<p class="profile-nome">' . $fetch_profile['nome'] . '</p>
                    <a href="usuario_atualizar_perfil.php" class="update-btn">Atualizar Perfil</a>
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
                </div>';

                if (isset($message_login)) {
                    foreach ($message_login as $message_login) {
                        echo '  
                                <div class="mensagem-login">
                                <span>' . $message_login . '</span>
                                </div>
                            ';
                    }
                }

                echo'
                <form action="" id="login" class="login-form" method="POST">
                    <input type="email" name="email" placeholder="Insira seu email" class="box" required>
                    <input type="password" name="senha" placeholder="Insira sua senha" class="box2" id="senha-id" required>
                    <div id="eye" class="eye" onclick="eyeClick()"></div>
                    <p>Esqueceu sua senha? <a href="#">Clique Aqui</a></p>
                    <input type="submit" name="entrar" value="Entrar" class="btn">
                </form>';

                if (isset($message_register)) {
                    foreach ($message_register as $message_register) {
                        echo '
                                <div class="mensagem-register">
                                <span>' . $message_register . '</span>
                                </div>
                            ';
                    }
                }

                echo'
                <form action="" method="POST" id="register" class="register-form">
                    <input type="text" name="nome" placeholder="Insira seu nome" class="box-r" required>
                    <input type="email" name="email" placeholder="Insira seu email" class="box-r" required>
                    <input type="password" name="senha" placeholder="Insira sua senha" class="box-r" required>
                    <input type="password" name="conf_senha" placeholder="Confirme sua senha" class="box-r" required>
                    <input type="submit" name="cadastro" value="Criar Conta" class="btn">
                    </form>';
            }
            ?>
        </div>
    </div>
    <script src="js/script.js"></script>
</header>
