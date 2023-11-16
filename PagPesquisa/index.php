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

<?php
include("../navbar/navbar.php");
?>

<?php
if (isset($_GET["mensagem"]) && !empty($_GET["mensagem"])) {
?>
    <div id="mensagem_excluir">
        <?php echo $_GET["mensagem"]; ?>
    </div>
<?php
}
?>

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
            <input name="busca" type="text" placeholder="Digite o nome do livro" size="30">
            <button type="submit" name="pesquisar">Pesquisar</button>
        </form>
        <br>
        <table border='1' width="800px">
            <tr>
                <th>Livros</th>
                <th>Autores</th>
                <th>Categorias</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>

            <?php
            if (!isset($_GET['busca'])) {
            ?>
                <tr>
                    <td colspan="5">Digite sua pesquisa...</td>
                </tr>
                <?php
            } else {
                $pesquisa = $conn->real_escape_string($_GET['busca']);
                $sql_code = 
                "SELECT 
                    liv.titulo as livros,
                    liv.status as status,
                    aut.nome as autores,
                    cat.categoriaTipo as categorias,
                    liv.id_livros
                FROM 
                    categorias cat 
                RIGHT JOIN 
                    livro_categoria lc ON cat.id_categorias = lc.id_categorias
                RIGHT JOIN 
                    livros liv ON lc.id_livros = liv.id_livros
                LEFT JOIN 
                    autores aut ON liv.autor = aut.id_autores
                WHERE 
                    liv.titulo LIKE '%$pesquisa%' OR aut.nome LIKE '%$pesquisa%';";

                $sql_query = $conn->query($sql_code) or die("ERRO AO CONSULTAR" . $conn->error);

                if ($sql_query->num_rows == 0) {
                ?>
                    <tr>
                        <td colspan='5'>Nenhum resultado encontrado...</td>
                    </tr>
                    <?php
                } else {
                    while ($dados = $sql_query->fetch_assoc()) {
                    ?>
                        <tr width="800px">
                            <td><?php echo $dados['livros']; ?>
                            </td>
                            <td><?php echo $dados['autores']; ?>
                            </td>
                            <td><?php echo $dados['categorias']; ?>
                            </td>
                            <td>
                                <?php $dados['status'] == 'a' ? print('ativo') : print('inativo'); ?>
                            </td>
                            <td>
                                <a href="../editarLivros/editaLivros.php?id_livros=<?php echo $dados['id_livros']; ?>">Editar</a>
                                <a href="../excluiLivros/deletaLivros.php?id=<?php echo $dados['id_livros']; ?>">Excluir</a>
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
</body>

</html>