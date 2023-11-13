<?php
include('../config/conexao.php');

if (!isset($_POST['cadastrar']))
    die("Sem acesso");

$autor = $_POST['autor'];
$nacionalidade = $_POST['nacionalidade'];
header("Location: ./?texto=Produto cadastrado com sucesso");

$mysqli = "INSERT INTO autores (nome, nacionalidade) VALUES ($autor, $nacionalidade);";
if (!mysqli_query($conn, $mysql)) {
    echo "Autor cadastrado com sucesso!";
} else {
    "Falha";
};
