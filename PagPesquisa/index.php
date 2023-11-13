<?php
include("conexao.php");
$query = $_GET['busca'];

if ($query) {
    $parametro = $query;
} else {
    $parametro = '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIOTECA</title>
</head>

<body>
    <h1>Biblioteca</h1>

    <div>
        <form action="" method="GET">
            <label for="Pesquisa"> Pesquisar livro:</label>
            <input name="busca" type="text" placeholder="Digite o nome livro ou o nome do Autor" size="30">
            <button type="submit">Pesquisar</button>
        </form>
        <br>
        <table border='1' width="600px">
            <tr>
                <th>Livros</th>
                <th>Autores</th>
                <th>Categorias</th>
            </tr>
            <?php
            if (!isset($_GET['busca'])) {
            ?>
                <tr>
                    <td colspan="3">Digite sua pesquisa...</td>
                </tr>
                <?php
            } else {
                $pesquisa = $mysqli->real_escape_string($_GET['busca']);
                $sql_code = "SELECT liv.titulo as livros, aut.nome as autores, cat.nome as categorias
                             FROM categorias cat 
                             INNER JOIN livro_categoria lc ON cat.id_categorias = lc.id_categoria
                             INNER JOIN livros liv ON lc.id_livro = liv.id_livros
                             INNER JOIN autores aut ON liv.autor = aut.id_autores
                             WHERE liv.titulo LIKE '%$pesquisa%'";

                $sql_query = $mysqli->query($sql_code) or die("ERRO AO CONSULTAR" . $mysqli->error);

                if ($sql_query->num_rows == 0) {
                ?>
                    <tr>
                        <td colspan='3'>Nenhum resultado encontrado...</td>
                    </tr>
                    <?php
                } else {
                    while ($dados = $sql_query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $dados['livros']; ?></td>
                            <td><?php echo $dados['autores']; ?></td>
                            <td><?php echo $dados['categorias']; ?></td>
                        </tr>

            <?php
                    }
                }
            }
            ?>
        </table>
    </div>
    <br>
    <div>
        <a href="../cadastroLivros/index.php"> Cadastrar livros</a>
    </div>
</body>

</html>