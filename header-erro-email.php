<header class="header">
    <img href="index.php" class="ifish-bar" src="img/ifishlogo-red.png" ">
    <nav class=" navbar">
    <a href="#">ínicio</a>
    <a href="#">produtos</a>
    <a href="#">categorias</a>
    <a href="#">sobre</a>
    <a href="#">contato</a>
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
            <button type="button" class="toggle-btn" onclick="login()" onclick="login2()">
                <p class="log-text" id="log-p">Logar</p>
            </button>
            <button type="button" class="toggle-btn" onclick="register()" onclick="register2()">
                <p class="reg-text" id="reg-p">Registrar</p>
            </button>
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