<?php
include("../config/conexao.php");

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

        <?php

        if (isset($_GET['id'])) {
            echo "Tem certeza que deseja deletar livro" . $_GET['id'];
        }
        ?>

        <form action="" method="GET">
            <label for="Pesquisa"> Pesquisar livro:</label>
            <input name="busca" type="text" placeholder="Digite o nome livro ou o nome do Autor" size="30">
            <button type="submit" name="pesquisar">Pesquisar</button>
        </form>
        <br>
        <table border='1' width="600px">
            <tr>
                <th>Livros</th>
                <th>Autores</th>
                <th>Categorias</th>
                <th>Deletar</th>
            </tr>

            <?php
            if (!isset($_GET['busca'])) {
            ?>
                <tr>
                    <td colspan="3">Digite sua pesquisa...</td>
                </tr>
                <?php
            } else {
                $pesquisa = $conn->real_escape_string($_GET['busca']);
                $sql_code = "SELECT liv.titulo as livros, aut.nome as autores, cat.categoriaTipo as categorias
                             FROM categorias cat 
                             INNER JOIN livro_categoria lc ON cat.id_categorias = lc.id_categorias
                             INNER JOIN livros liv ON lc.id_livros = liv.id_livros
                             INNER JOIN autores aut ON liv.autor = aut.id_autores
                             WHERE liv.titulo LIKE '%$pesquisa%'";

                $sql_query = $conn->query($sql_code) or die("ERRO AO CONSULTAR" . $conn->error);

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
                            <td><?php echo $dados['livros']; ?>
                            </td>
                            <td><?php echo $dados['autores']; ?>
                            </td>
                            <td><?php echo $dados['categorias']; ?>
                            </td>

                            <td>
                                <a href="delete.php?id=<?php echo $dados['livros']; ?>">Excluir</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>
        </table>
    </div>
    <br>
    <button>
        <a href="../cadastroLivros/index.php">cadastrar livro</a>
    </button>

    <button>
        <a href="../cadastroAutores/index.php">cadastrar autor</a>
    </button>
</body>

</html>