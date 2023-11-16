<?php
include("../config/conexao.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../navbar/style.css">
    <link rel="stylesheet" href="cadastroAutores.css">
    <title>Document</title>
</head>

<?php
    include("../navbar/navbar.php");
?>

<?php
if (isset($_GET["texto"]) && !empty($_GET["texto"])) {
?>
<div id="mensagem_cadastrar">
    <?= isset($_GET['texto']) ? $_GET['texto'] : "" ?>
</div>

<?php
}
?>

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

</body>

</html>