<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>IFISH</title>
        <link rel="shortcut icon" href="img/ifish-icon.png">
        <link rel="stylesheet" href="login-erro-email.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    </head>
    <body class="body">
        <!--Barra de Navegação -->
        <header class="header">   
            <img href="index.php" class="ifish-bar" src="img/ifishlogo-red.png" ">
            <nav class="navbar">
                <a href="#">home</a>
                <a href="#">lorem</a>
                <a href="#">produtos</a>
                <a href="#">categorias</a>
                <a href="#">lorem</a>
                <a href="#">ajuda</a>
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
                <div id="btn"></div>
                <div class="button-box">
                    <button type="button" class="toggle-btn" onclick="login()" onclick="login2()"><p class="log-text" id="log-p">Logar</p></button>
                    <button type="button" class="toggle-btn" onclick="register()" onclick="register2()"><p class="reg-text" id="reg-p">Registrar</p></button>
                </div>
                    <form action="conf_login.php" id="login" class="login-form" method="POST">
                    <h5 id="text-error">Email Incorreto ou não cadastrado</h5>
                    <input type="email" name="email" value="" placeholder="Insira seu email" class="box" required>
                    <input type="password" name="senha" placeholder="Insira sua senha" class="box2" id="senha-id" required>
                    <div id="eye" class="eye" onclick="eyeClick()"></div>
                    <p>Esqueceu sua senha? <a href="#">Clique Aqui</a></p>
                    <input type="submit" value="logar" class="btn">
                </form>
                <form action="recebe_cad_comprador.php" method="POST" id="register" class="register-form">
                    <input type="text" name="nome" placeholder="Nome" class="box-r" required>
                    <input type="text" name="sobrenome" placeholder="Sobrenome" class="box-r" required><br>
                    <input placeholder="Data de Nascimento" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="data_nascimento" class="box-r" required><br>
                    <input type="text" name="cpf_cnpj" placeholder="Insira seu CPF/CNPJ" class="box-r" required>
                    <input type="email" name="email" placeholder="Insira seu email" class="box-r" required>
                    <input type="password" name="senha" placeholder="Insira sua senha" class="box-r" required>
                    <input type="submit" value="register" class="btn">
                </form>
            </div>                    
        </header>       
        <!--início-->
        <div class="inicial-main">

            <div class="incial-left">
                <div class="inicial-text">
                    <h4 class="text-h4">LoremIpsum</h4>
                    <h1 class="text-h1">LoremIpsum<br>LoremIpsumm</h1>
                    <p class="p">LoremIpsumLoremIpsumLoremIpsumLoremIpsum</p>
                    <a href="#" class="inicial-btn">Lorem Ipsum</a>
                </div>
            </div>
            <div class="inicial-right">    
                <section class="container">
                    <div class="slides">
                        <input type="radio" name="radio" id="radio-1" checked>
                        <input type="radio" name="radio" id="radio-2">
                        <input type="radio" name="radio" id="radio-3">
                        <input type="radio" name="radio" id="radio-4">

                        <div class="imagens one">
                            <img src="img/slides/1.png" alt="imagens">
                        </div>
                        <div class="imagens">
                            <img src="img/slides/2.png" alt="imagens">
                        </div>
                        <div class="imagens">
                            <img src="img/slides/3.jpg" alt="imagens">
                        </div>
                        <div class="imagens">
                            <img src="img/slides/4.jpg" alt="imagens">
                        </div>
                    </div>
                    <div class="roll-slide">
                        <label for="radio-1" class="nav"></label>
                        <label for="radio-2" class="nav"></label>
                        <label for="radio-3" class="nav"></label>
                        <label for="radio-4" class="nav"></label>
                    </div> 
                </section>   
            </div>
        </div>
        <!--Login-->
        <!---
        <div class="main-login">
            <div class ="left-img">
                <img src="img/ifishlogo-red.png" class="ifish">
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
                        </div>
                        <button class="btn-login">Entrar</button>
                        <p>Ainda não tem uma conta?<a href="cadastro.php" class="btn-cadastro">Cadastre-se</a>
                    </div>
                </div>
            </form>
            -->
        </div>
        <script src="script-erro-email.js"></script>
    </body>
</html>