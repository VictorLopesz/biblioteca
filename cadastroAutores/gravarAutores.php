<?php
include('../config/conexao.php');
echo '<pre>';
print_r($_POST);
if (!isset($_POST['cadastrar']))
    die("Sem acesso");

$autor = $_POST['nome'];
$nacionalidade = $_POST['nacionalidade'];
header("Location: ./?texto=Autor cadastrado com sucesso");

$mysqli = "INSERT INTO autores (nome, nacionalidade) VALUES ('$autor', '$nacionalidade');";
if (!mysqli_query($conn, $mysqli)) {
    echo "Autor cadastrado com sucesso!";
} else {
    "Falha";
};

mysqli_close($conn);


// $mysqli = "INSERT INTO livros (titulo, autor, ano, status) 
// VALUES ($titulo, $autor, $ano, $status);";
// if (mysqli_query($conn, $mysqli)) {
//     echo "Livro cadastrado com sucesso!";
// } else {
//     "falha";
// };

// mysqli_close($conn);