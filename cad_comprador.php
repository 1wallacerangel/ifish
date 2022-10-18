<?php
// put your code here
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>IFISH</title>
        <link rel="stylesheet" href="cad.css">
    </head>

    <body>
        <div class="main-login">
            <form action="recebe_cad_comprador.php" method="POST">
                <div class="card-cad">
                    <h1> Cadastrar </h1>
                    <div class="textfield">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" placeholder="Nome" required> <br>
                    </div>
                    <div class="textfield">
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" name="sobrenome" placeholder="Sobrenome" required><br>
                    </div>
                    <div class="textfield">
                        <label for="datadenascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" required><br>
                    </div>
                    <div class="textfield">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="E-mail" required> <br>
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Senha"required> <br>
                    </div>
                    <input type="submit" value="CADASTRAR" class="btn-login"> 
                </div>
            </form>
        </div>   
    </body>
</html>
