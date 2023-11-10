<?php

include("conexao.php");
$query = $_GET['query'];

if ($query) {

    $parametro = $query;

} else {
    $query = "";
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
            <input name="busca" type="text" placeholder="Digite o nome livro ou o nome do Autor" size="30" required>
            <button type="submit">
                Pesquisar
            </button>
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
                $sql_code = "SELECT liv.titulo, aut.nome, cat.nome
                FROM categorias cat inner join livro_categoria lc
                on cat.id_categorias = lc.id_categoria
                inner join livros liv 
                on lc.id_livro = liv.id_livros
                inner join autores aut ON liv.autor = aut.id_autores
                --where liv.titulo = '$parametro'
                ";
                $sql_query = $mysqli->query($sql_code) or die("ERRO AO CONSULTAR" . $mysqli->error);
                
                if($sql_query->num_rows == 0){
                    ?>
                    <tr>
                        <td colspan='3'>Nenhum resultado encontrado...</td>
                    </tr>
                <?php
                } else {

                }

                ?>

            <?php
            } ?>
        </table>
    </div>
</body>

</html>