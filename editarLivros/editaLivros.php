<?php
include("../config/conexao.php");

try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=biblioteca", 'root', "");

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

if (isset($_POST) && !empty($_POST)) {

    include("../config/conexao.php");
    $id = $_POST["id_livros"];
    $titulo = $_POST["titulo"];
    $ano = $_POST["ano"];
    $autor = $_POST["autor"];
    $categoria = $_POST["categoriaTipo"];
    $status = $_POST["status"] == "i" ? true : false;

    $query = "UPDATE livros SET titulo = '$titulo', ano = '$ano', autor = '$autor', categoria = '$categoria', status = '$status'
        WHERE id = " . $id;
    $resultado = mysqli_query($conn, $query);
    header("Location: ./PagPesquisa/index.php?mensagem=Usuário editado com sucesso");
    exit();
} else if (isset($_GET["id_livros"]) && !empty($_GET["id_livros"])) { //o id que precisa ser passado é o mesmo do banco de dados

    include("../config/conexao.php");
    $query = "SELECT 
                lv.id_livros,
                lv.titulo,
                lc.id_categorias,
                cat.categoriaTipo,
                lv.ano,
                aut.nome,
                lv.status
                FROM livros lv
                INNER JOIN autores aut ON lv.autor = aut.id_autores
                INNER JOIN livro_categoria lc ON lv.id_livros = lc.id_livros
                INNER JOIN categorias cat ON lc.id_categorias = cat.id_categorias
                WHERE lv.id_livros =" . $_GET["id_livros"];

    $resultado = mysqli_query($conn, $query);

    $dados = mysqli_fetch_array($resultado);

    $id = $dados["id_livros"]; //O id que precisa ser passado como argumento é o id do banco de dados
    $titulo = $dados["titulo"];
    $ano = $dados["ano"];
    $autor = $dados["nome"];
    $categoria = $dados["categoriaTipo"];
    $status = $dados["status"];
} else {
    header("Location: ../PagPesquisa/index.php?mensagem=Selecione um usuário para editar");
    exit();
}

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
    <form action="editaLivros.php" method="POST">
        <input type="hidden" name="id_livros" readonly value="<?= $livro['id_livros']; ?>">
        <label>Livro:</label>
        <input type="text" name="titulo" value="<?= $livro['titulo']; ?>" placeholder="Digite o novo nome para o livro" size=30 required>
        <br>
        <br>
        <label for="">Autor:</label>
        <select id="nome" name="nome" required>
            <?php
            $sql = 'select * from autores order by nome';
            $query = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($query)) {
                $selected = ($row['nome'] == $autor) ? 'selected' : '';
                echo "<option value='$row[0]' $selected>{$row['nome']}</option>";
            }
            ?>
        </select>
        <br>
        <br>
        <label for="">Categoria:</label>
        <select name="categoriaTipo" id="categoriaTipo" value="<?php echo $categoria ?>" required>
            <?php
            $sql = "select * from categorias order by categoriaTipo;";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($query)) {
                $selected = ($row['categoriaTipo'] == $categoria) ? 'selected' : '';
                echo "<option value='$row[0]' $selected>{$row['categoriaTipo']}</option>";
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
        <?php
        if ($status === 'i') {
        ?>
            <input type="radio" name="status" value="<?= $livro['status']; ?>">Ativo</input>
            <input type="radio" name="status" checked value="<?= $livro['status']; ?>">Inativo</input>
        <?php
        } else {
        ?>
            <input type="radio" name="status" checked value="<?= $livro['status']; ?>">Ativo</input>
            <input type="radio" name="status" value="<?= $livro['status']; ?>">Inativo</input>

        <?php
        }
        ?>

        <br>
        <br>
        <input type="submit" value="Atualizar">

    </form>

</body>

</html>