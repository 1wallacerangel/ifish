<?php

include_once ("conexao.php");

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$data_nascimento = $_POST['data_nascimento'];
$cpf_cnpj = $_POST['cpf_cnpj'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO cad_comprador(nome, sobrenome, data_nascimento,cpf_cnpj, email, senha)VALUES('$nome', '$sobrenome', '$data_nascimento','$cpf_cnpj', '$email','$senha')";

$sql = mysqli_query($conn, $sql);
?>