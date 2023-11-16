<?php

include('../config/conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../navbar/style.css">
    <title>Document</title>
</head>

<?php
    include('../navbar/navbar.php');
?>

<body>
    <div>
        <form action="gravarLivro.php" method="POST">
            <h3>CADASTRAR LIVROS</h3>
            <?= isset($_GET['texto']) ? $_GET['texto'] : "" ?>
            <div>
                <label for="nome">Nome do livro:</label>
                <input name="titulo" id="titulo" type="text" placeholder="Digite o nome do livro" size="30" required>
            </div>
            <br>
            <div>
                <label for="">Nome do autor:</label>
                <select id="autor" name="autor" required>
                    <?php
                    $sql = 'select * from autores';
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        echo "<option value='$row[0]'>{$row['nome']}</option>";
                    }
                    ?>
                </select>

                <!-- <button>
                    <a href="http://localhost:8000/cadastroAutores/index.php">Cadastrar autor</a>
                </button> -->
            </div>
            <br>
            <div>
                <label for="">Categoria:</label>
                <select id="categoriaTipo" name="categoriaTipo" required>
                    <?php
                    $sql = 'select * from categorias';
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        echo "<option value='$row[0]'>{$row['categoriaTipo']}";
                    }
                    ?>

                </select>
            </div>
            <br>

            <div>
                <label for="">Data de Lançamento:</label>
                <input type="date" id="ano" name="ano" required>
            </div>
            <br>
            <div>
                <label for="">Status:</label>
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