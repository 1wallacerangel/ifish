<?php

include_once ("conexao.php");

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$data_nascimento = $_POST['data_nascimento'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO cad_vendedor (nome, sobrenome, data_nascimento, email, senha) "
        . "VALUES('$nome', '$sobrenome', '$data_nascimento', '$email','$senha')";

$sql = mysqli_query($conn, $sql);
?> 