<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>IFISH</title>
        <link rel="stylesheet" href="index.css">
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
            <form action="" class="search-form">
                <input type="search" id="search-box" placeholder="lorem...">
                <label for="search-box" class="fas fa-search"></label>
            </form>
            <div class="shopping-cart">
                <div class="box">
                    <i class="fas fa-trash"></i>
                    <img src="image/cart-img-1.png" alt="">
                    <div class="content">
                        <h3>fish</h3>
                        <span class="preco">R$ 4.99 </span>
                        <span class="quantidade">qtd : 1</span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-trash"></i>
                    <img src="image/cart-img-2.png" alt="">
                    <div class="content">
                        <h3>fish</h3>
                        <span class="preco">R$ 4.99 </span>
                        <span class="quantidade">qtd : 1</span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-trash"></i>
                    <img src="image/cart-img-3.png" alt="">
                    <div class="content">
                        <h3>fish</h3>
                        <span class="preco">R$ 4.99 </span>
                        <span class="quantidade">qtd : 1</span>
                    </div>
                </div>
                <div class="total"> total : R$ 14.97 </div>
                <a href="#" class="btn">finalizar</a>
            </div>

            <form action="" class="login-form">
                <h3>logue agora</h3>
                <input type="email" placeholder="your email" class="box">
                <input type="password" placeholder="your password" class="box">
                <p>Esqueceu sua senha? <a href="#">Clique Aqui</a></p>
                <p>Ainda não tem uma conta? <a href="#">crie agora</a></p>
                <input type="submit" value="logar" class="btn">
            </form>          
        </header>       
        <!--início-->
        <div class="inicial-main">
            <!--<div class="icon ">
                <img class="moon" src="img/moon.png ">
                <img class="sun" src="img/sun.png ">
            </div>-->
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
        </div>-->
        <script src="script.js"></script>
    </body>
</html>