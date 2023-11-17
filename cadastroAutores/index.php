<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../navbar/style.css">
    <link rel="stylesheet" href="cadastroAutores.css">
    <title>Document</title>
</head>

<body>

    <?php include("../navbar/navbar.php"); ?>

    <?php if (isset($_GET["texto"]) && !empty($_GET["texto"])) { ?>
        <div id="mensagem_cadastrar">
            <?= isset($_GET['texto']) ? $_GET['texto'] : "" ?>
        </div>
    <?php } ?>

    <div class="container">
        <h1 class="cadastrarAutores">CADASTRAR AUTORES</h1>
        <form action="gravarAutores.php" method="POST" class="author-form">
            <div>
                <label for="nome">Nome do autor:</label><br>
                <input name="nome" id="nome" type="text" placeholder="Digite o nome do Autor" size="20" required>
            </div>
            <br>
            <div>
                <label for="nacionalidade">Nacionalidade:</label><br>
                <input name="nacionalidade" id="nacionalidade" type="text" placeholder="Digite a nacionalidade do Autor" size="20" required>
            </div>
            <br>
            <input type="submit" value="Cadastrar" name="cadastrar">
        </form>
    </div>
    <br><br>

</body>

</html>
