<?php

include_once ("conexao.php");

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$data_nascimento = $_POST['data_nascimento'];
$cpf_cnpj = $_POST['cpf_cnpj'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$num_cpf_cnpj = strlen($cpf_cnpj);

if ($num_cpf_cnpj > 11) {
    echo "Tem mais de 11 Caracteres";
 } else {
    echo "Essa string tem $num_cpf_cnpj caracteres.";
 }

$sql = "INSERT INTO cad_comprador(nome, sobrenome, data_nascimento,cpf_cnpj, email, senha)VALUES('$nome', '$sobrenome', '$data_nascimento','$cpf_cnpj', '$email','$senha')";

$sql = mysqli_query($conn, $sql);
?>