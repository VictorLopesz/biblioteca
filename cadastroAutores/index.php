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
    <div>
        <label for="">Nome do autor:</label>
        <input name="autor" id="autor" type="text" placeholder="Digite o nome do Autor" size="30" required>
    </div>
    <br>
    <div>
        <label for="">Nacionalidade:</label>
        <input name="nacionalidade" id="nacionalidade" type="text" placeholder="Digite o nome do Autor" size="30" required>
    </div>
    <br>
    <input type='submit' name="cadastrar">

</body>

</html>