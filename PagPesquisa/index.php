<?php
include("../config/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../navbar/style.css">
    <link rel="stylesheet" href="pagPesquisa.css">
    <link href="styles.css" rel="stylesheet">
    <title>BIBLIOTECA</title>
</head>

<body>

    <?php include("../navbar/navbar.php"); ?>

    <?php if (isset($_GET["mensagem"]) && !empty($_GET["mensagem"])) { ?>
        <div id="mensagem_excluir">
            <?php echo $_GET["mensagem"]; ?>
        </div>
    <?php } ?>

    <div class="container">
        <h1 class="main-title">Biblioteca</h1>

        <?php
        if (isset($_GET['id'])) {
            echo "Tem certeza que deseja deletar o livro com ID " . $_GET['id'];
        }
        ?>

        <form action="" method="GET" class="search-form">
            <label for="Pesquisa" id="pesquisa"> Pesquisar livro:</label>
            <input name="busca" type="text" placeholder="Digite o nome do livro" size="30">
            <button type="submit" name="pesquisar">Pesquisar</button>
        </form>

        <br>

        <table border='1' class="data-table">
            <tr>
                <th>Livros</th>
                <th>Autores</th>
                <th>Categorias</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>

            <?php
            if (!empty($_GET['busca'])) {
                $pesquisa = $conn->real_escape_string($_GET['busca']);
                $sql_code = "   SELECT 
                                    liv.id_livros as id_livros,
                                    liv.titulo as livros,
                                    liv.status as status,
                                    aut.nome as autores,
                                    cat.categoriaTipo as categorias,
                                    liv.id_livros
                                FROM categorias cat
                                RIGHT JOIN livro_categoria lc ON cat.id_categorias = lc.id_categorias
                                RIGHT JOIN livros liv ON lc.id_livros = liv.id_livros
                                LEFT JOIN autores aut ON liv.autor = aut.id_autores
                                WHERE cat.categoriaTipo LIKE '%$pesquisa%' OR liv.titulo LIKE '%$pesquisa%' OR aut.nome LIKE '%$pesquisa%'
                                ORDER BY liv.titulo;";

                $sql_query = $conn->query($sql_code) or die("ERRO AO CONSULTAR: " . $conn->error);

                if ($sql_query->num_rows == 0) {
            ?>
                    <?php } else {
                    while ($dados = $sql_query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $dados['livros']; ?></td>
                            <td><?php echo $dados['autores']; ?></td>
                            <td><?php echo $dados['categorias']; ?></td>
                            <td class="status <?php echo ($dados['status'] === 'a') ? 'ativo' : 'inativo'; ?>">
                                <?php echo ($dados['status'] == 'a') ? 'ativo' : 'inativo'; ?>
                            </td>
                            <td>
                                <a href="../editarLivros/editar.php?id=<?php echo $dados['id_livros']; ?>" class="edit-link">
                                    <img class="imge" src="../img/editar.png" alt="editar">
                                </a>

                                <a href="../excluiLivros/deletaLivros.php?id=<?php echo $dados['id_livros']; ?>" class="delete-link">
                                    <img class="imge" src="../img/excluir.png" alt="excluir">

                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
            } else {
                $sql_code = "   SELECT 
                liv.id_livros as id_livros,
                liv.titulo as livros,
                liv.status as status,
                aut.nome as autores,
                cat.categoriaTipo as categorias,
                liv.id_livros
            FROM categorias cat
            RIGHT JOIN livro_categoria lc ON cat.id_categorias = lc.id_categorias
            RIGHT JOIN livros liv ON lc.id_livros = liv.id_livros
            LEFT JOIN autores aut ON liv.autor = aut.id_autores;";

                $sql_query = $conn->query($sql_code) or die("Erro ao consultar" . $conn->error);

                ?>

            <?php }
            if ($sql_query->num_rows == 0) {
            ?>
                <tr>
                    <td colspan='5'>Nenhum livro encontrado...</td>
                </tr>
                <?php } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $dados['livros']; ?></td>
                        <td><?php echo $dados['autores']; ?></td>
                        <td><?php echo $dados['categorias']; ?></td>
                        <td class="status <?php echo ($dados['status'] === 'a') ? 'ativo' : 'inativo'; ?>">
                            <?php echo ($dados['status'] == 'a') ? 'ativo' : 'inativo'; ?>
                        </td>
                        <td>
                            <a href="../editarLivros/editar.php?id=<?php echo $dados['id_livros']; ?>" class="edit-link">
                                <img class="imge" src="../img/editar.png" alt="editar">
                            </a>

                            <a href="../excluiLivros/deletaLivros.php?id=<?php echo $dados['id_livros']; ?>" class="delete-link">
                                <img class="imge" src="../img/excluir.png" alt="excluir">

                            </a>
                        </td>
                    </tr>
            <?php
                }
            }

            ?>
        </table>
    </div>
    <br>
</body>

</html>