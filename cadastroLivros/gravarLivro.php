<?php
include('../config/conexao.php');

if (!isset($_POST['cadastrar']))
    die("Sem acesso");

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$nacionalidade = $_POST['nacionalidade'];
$nome = $_POST['nome'];
$ano = $_POST['ano'];
header("Location: ./?texto=Produto cadastrado com sucesso");

$mysqli = "INSERT INTO livros (titulo) VALUES ('$titulo');";
if (!mysqli_query($conn, $mysql))
    die("Falha");

