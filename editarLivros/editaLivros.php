<?php
include("../config/conexao.php");

try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=biblioteca", 'root', "");

    $livro = [];
    $id = filter_input(INPUT_GET, "id_livros", FILTER_SANITIZE_NUMBER_INT);

    if ($id) {
        $sql = $pdo->prepare("SELECT * FROM livros WHERE id_livros = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $livro = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            header("Location: ../PagPesquisa/index.php?mensagem=Erro ao editar livro");
            exit;
        }
    } else {
        header("Location: ../PagPesquisa/index.php");
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// if ($livro['status'] = 'i') {
//     $checkedInativo = true;
//     $checkedAtivo = false;
//     echo('inativo');
// } else {
//     $checkedAtivo = true;
//     $checkedInativo = false;
//     echo('ativo');
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../navbar/style.css">
    <title>Document</title>
</head>

<header>
    <?php
    include("../navbar/navbar.php");
    ?>
</header>

<body>
    <h1>
        Editar Livro
    </h1>
    <form action="editar.php" method="POST">
        <input type="hidden" name="id_livros" value="<?= $livro['id_livros']; ?>" >
        <label>Livro:</label>
        <input type="text" name="titulo" value="<?= $livro['titulo']; ?>" placeholder="Digite o novo nome para o livro" size=30 required>
        <br>
        <br>
        <label for="">Autor:</label>
        <select id="id_autores" name="id_autores" value="<?= $livro['id_autores']; ?>" required>
            <?php
            $sql = 'select * from autores';
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($query)) {
                echo "<option value='$row[0]'>{$row['nome']}</option>";
            }
            ?>
        </select>
        <br>
        <br>
        <label for="">Categoria:</label>
        <select name="categoria" id="categoria" value="<?= $livro['categoriaTipo']; ?>" required>
            <?php
            $sql = "select * from categorias";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($query)) {
                echo "<option value='$row[0]'>{$row['categoriaTipo']}</option>";
            }
            ?>
        </select>
        <br>
        <br>
        <label for="">Data de Lançamento</label>
        <input type="date" value="<?= $livro['ano']; ?>">
        <br>
        <br>
        <label for="">Status:</label>
        <input type="radio" name="status" checked value="<?= $livro['status']; ?>">Ativo</input>
        <input type="radio" name="status" value="<?= $livro['status']; ?>">Inativo</input>

        <br>
        <br>
        <input type="submit" value="Atualizar">

    </form>

</body>

</html>