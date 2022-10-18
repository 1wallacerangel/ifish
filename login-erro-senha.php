<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>IFISH</title>
        <link rel="stylesheet" href="css/login-erro-senha.css">
    </head>

    <body>
        <div class="main-login">
            <div class ="left-img">
                <img src="img/ifishlogo.png" class="ifish">
            </div>
            <form action="conf_login.php" method="POST">
                <div class ="right-login">  
                    <div class="card-login">
                        <h1>LOGIN</h1>
                        <div class="textfield">
                            <label for="email">Email</label>
                            <Input type="text" name="email" placeholder="Email" required>
                        </div>
                        <div class="textfield">
                            <label for="senha">Senha</label>
                            <Input type="password" name="senha" placeholder="Senha"required>
                            <p class="senha-erro">Senha incorreta</p>
                        </div>
                        <button class="btn-login">Entrar</button>
                        <p>Ainda não tem uma conta?<a href="cadastro.php" class="btn-cadastro">Cadastre-se</a>
                    </div>
                   
                </div>
            </form>
        </div>    
    </body>
</html>
