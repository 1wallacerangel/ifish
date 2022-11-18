<?php

include 'conexao.php';

if(isset($_POST['submit_register'])){

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

   if($select->rowCount() > 0){
      $message_register[] = 'user email already exist!';
   }else{
      if($senha != $conf_senha){
         $message_register[] = 'confirm password not matched!';
      }else{
         $insert = $conn->prepare("INSERT INTO `usuario`(nome, email, senha) VALUES(?,?,?)");
         $insert->execute([$nome, $email, $senha ]);
         $message_register[] = 'registrado!';
      }
   }
}

?>

<?php

@include 'conexao.php';

session_start();

if(isset($_POST['submit_login'])){

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

        $_SESSION['user_id'] = $row['id'];
        $message_login[] = 'Logado!';     
    }else{
        $message_login[] = 'incorrect email or password!';
    }
}
?>

<header class="header">
    <img href="index.php" class="ifish-bar" src="img/ifishlogo-red.png" ">
    <nav class=" navbar">
    <a href="index.php">ínicio</a>
    <a href="#">produtos</a>
    <a href="#">categorias</a>
    <a href="logout.php">sobre</a>
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
    <form action="" class="search-form">
        <input type="search" id="search-box" placeholder="lorem...">
        <label for="search-box" class="fas fa-search"></label>
    </form>
    <div class="shopping-cart">
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="img/" alt="">
            <div class="content">
                <h3>fish</h3>
                <span class="preco">R$ 4.99 </span>
                <span class="quantidade">qtd : 1</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="img/" alt="">
            <div class="content">
                <h3>fish</h3>
                <span class="preco">R$ 4.99 </span>
                <span class="quantidade">qtd : 1</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="img/" alt="">
            <div class="content">
                <h3>fish</h3>
                <span class="preco">R$ 4.99 </span>
                <span class="quantidade">qtd : 1</span>
            </div>
        </div>
        <div class="total"> total : R$ 14.97 </div>
        <a href="#" class="btn">finalizar</a>
    </div>
    <div class="log-register">
        <div class="profile">
            <?php

            if($_SESSION){

                $select_profile = $conn->prepare("SELECT * FROM `usuario` WHERE id = ?");
                $select_profile->execute([$user_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                
                echo '<p>' .$fetch_profile['']. '</p>
                <a href="logout.php" class="delete-btn">logout</a>';

            }else{

            }
            ?>
            <p><?= $fetch_profile['nome']; ?></p>
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
            if(isset($message_login)){
                foreach($message_login as $message_login){
                    echo '
                        <div class="message">
                        <span>'.$message_login.'</span>
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
            if(isset($message_register)){
                foreach($message_register as $message_register){
                    echo '
                        <div class="message">
                        <span>'.$message_register.'</span>
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