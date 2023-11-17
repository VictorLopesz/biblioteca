<?php
include('../config/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../navbar/style.css">
    <link rel="stylesheet" href="cadastroLivros.css">
    <title>Document</title>
</head>

<body>

    <?php include('../navbar/navbar.php'); ?>

    <?php if (isset($_GET["texto"]) && !empty($_GET["texto"])) { ?>
        <div id="mensagem_cadastrar">
            <?= isset($_GET['texto']) ? $_GET['texto'] : "" ?>
        </div>
    <?php } ?>

    <div class="container">
        <form action="gravarLivro.php" method="POST" class="book-form">
            <h1>CADASTRAR LIVROS</h1>
            <div>
                <label for="titulo">Nome do livro:</label><br>
                <input name="titulo" id="titulo" type="text" placeholder="Digite o nome do livro" size="30" required>
            </div>
            <br>
            <div>
                <label for="autor">Nome do autor:</label><br>
                <select id="autor" name="autor" required>
                    <?php
                    $sql = 'select * from autores';
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        echo "<option value='$row[0]'>{$row['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <div>
                <label for="categoriaTipo">Categoria:</label><br>
                <select id="categoriaTipo" name="categoriaTipo" required>
                    <?php
                    $sql = 'select * from categorias';
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        echo "<option value='$row[0]'>{$row['categoriaTipo']}</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <div>
                <label for="ano">Data de Lançamento:</label><br>
                <input type="date" id="ano" name="ano" required>
            </div>
            <br>
            <div>
                <label>Status:</label>
                <input type="radio" id="ativo" name="status" value="a">
                <label for="ativo">Ativo</label>
                <input type="radio" id="inativo" name="status" value="i">
                <label for="inativo">Inativo</label><br>
            </div>
            <br>
            <input type='submit' name="cadastrar">
        </form>
        <br>
    </div>
</body>

</html>