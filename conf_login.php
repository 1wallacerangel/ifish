<?php
// login cadastro comprador

session_start();

include('conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM cad_comprador WHERE email = '$email'";

if ($resultado = mysqli_query($conn, $sql)) {
    $num_rows = mysqli_num_rows($resultado);
    // testando se o cadastro existe

    if ($num_rows > 0) {
        // testar se a senha confere

        //echo "CADASTRO EXISTE!!";
        $sql = "SELECT nome FROM cad_comprador WHERE email = '$email' and senha = '$senha'";

        if ($resultado = mysqli_query($conn, $sql)) {
            $num_rows = mysqli_num_rows($resultado);
            if ($num_rows > 0) {
                //$nome = $resultado['nome'];
                // ACERTOU A SENHA
                $_SESSION['email'] = $email;
                header("location: menu-principal.php");
            } else {
                // ERROU A SENHA
                header("location: login-erro-senha.php");
                //echo "ERROU A SENHA BURRO";
            }
        } else {
            // ERRO NO SQL
        }
    } else {
        header("location: login-erro-email.php");
        //echo "CADASTRO NAO EXISTE!";
    }
} else {
    echo "ERRO NA VERIFICACAO DO LOGIN; <br>";
}
?>