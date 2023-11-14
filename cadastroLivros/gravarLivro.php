<?php
include('../config/conexao.php');
echo '<pre>';
print_r($_POST);

if (!isset($_POST['cadastrar'])) {
    die("Sem acesso");
}

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoriaTipo = $_POST['categoriaTipo'];
$ano = $_POST['ano'];
$status = $_POST['status'];

$sqlLivros = "INSERT INTO livros (titulo, autor, ano, status) 
VALUES ('$titulo', '$autor', '$ano', '$status')";

if (mysqli_query($conn, $sqlLivros)) {
    $id_livros = mysqli_insert_id($conn);

    $sqlLivroCategoria = "INSERT INTO livro_categoria (id_categorias, id_livros)
                          VALUES ($categoriaTipo, $id_livros)";

    if (mysqli_query($conn, $sqlLivroCategoria)) {
        echo "Livro cadastrado com sucesso!";
        header("Location: ./?texto=Produto cadastrado com sucesso");
    } else {
        echo "Erro ao cadastrar livro na categoria: " . mysqli_error($conn);
    }
} else {
    echo "Erro ao cadastrar livro: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
