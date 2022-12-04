<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IFISH</title>
        <link rel="shortcut icon" href="img/ifish-icon.png">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    </head>
    <body class="body">
        <div id="butter">
        <!--Barra de Navegação -->
        <?php include 'header.php'; ?>
        <!--início-->
        <div class="inicial-main">
            <div class="incial-left">
                <div class="inicial-text">
                    <h4 class="text-h4">LoremIpsum</h4>
                    <h1 class="text-h1">LoremIpsum<br>LoremIpsumm</h1>
                    <p class="p">LoremIpsumLoremIpsumLoremIpsumLoremIpsum</p>
                    <a href="#" class="inicial-btn">Sobre Nós</a>
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
        <?php include 'footer.php'; ?>
</div>
    
    <script src="js/script.js"></script>
    <script src="js/butter.js"></script>
    <!--<script>butter.init({cancelOnTouch: true});</script>-->
    </body>
</html>