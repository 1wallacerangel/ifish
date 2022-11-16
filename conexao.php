<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "cadastro";

$conn = new mysqli($servidor, $usuario, $senha, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
//echo "CONECTADO COM SUCESSO!";
?>