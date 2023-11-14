<?php
include("../config/conexao.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>
        CADASTRAR AUTORES
    </h3>
    <form action="gravarAutores.php" method="POST">
        <div>
            <label for="">Nome do autor:</label>
            <input name="nome" id="nome" type="text" placeholder="Digite o nome do Autor" size="30" required>
        </div>
        <br>
        <div>
            <label for="">Nacionalidade:</label>
            <input name="nacionalidade" id="nacionalidade" type="text" placeholder="Digite o nome do Autor" size="30" required>
        </div>
        <br>
        <input type="submit" value="cadastrar" name="cadastrar">
    </form>
<br><br>
    <button >
        <a href="http://localhost:8000/cadastroLivros/index.php">cadastrar livros</a>
    </button>
    <button >
        <a href="http://localhost:8000/PagPesquisa/index.php">pesquisar livros</a>
    </button>

</body>

</html>