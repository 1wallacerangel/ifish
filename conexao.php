<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "cadastro";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

if (mysqli_connect_errno()) {
    die("FALHOU: " . mysqli_connect_error());
}
header("location:index.php");
//echo "CONECTADO COM SUCESSO!";
?>
<hmtl>
    <br><a href="login.php"<h3>Fazer Login</h3></a>
    <br><a href="index.php"<h3>Voltar a página inicial</h3></a>
</html>
