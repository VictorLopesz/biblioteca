<?php
include("../config/conexao.php");

//1º Verificar se o ID para editar NÃO está vazio
if (isset($_GET["id"]) && !empty($_GET["id"])) { //O id a ser passado aqui é o mesmo id que possui na URL quando selecionar um item para editar

    //2º Será feita a consulta SQL no banco de dados - se o id não estiver vazio - para buscar as colunas que precisam ser editadas
    $sql = "SELECT 
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
WHERE lv.id_livros =" . $_GET["id"];

    //3º Essa variável roda a conexão com o MySQL fazendo uma consulta
    $result = $conn->query($sql);
}
//4º Essa condicional inform o número de linhas, 
// caso seja maior, ele pega as informações abaixo baseadas na consulta SQL 2º
if ($result->num_rows > 0) {

    while ($book_data = mysqli_fetch_assoc($result))
    //Aqui ele fará uma busca associada 
    {
        $id = $book_data["id_livros"];
        $titulo = $book_data["titulo"];
        $autor = $book_data["nome"];
        $categoria = $book_data["categoriaTipo"];
        $ano = $book_data["ano"];
        $status = $book_data["status"];
    }
    //caso ele seja menor que 0, ele não existirá no banco de dados e cairá no ELSE, retornando para a página de pesquisa com uma mensagem
} else {
    header('Location: ../pagPesquisa/index.php?mensagem=Selecione um item válido para editar');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../navbar/style.css">
    <link rel="stylesheet" href="editarLivro.css">
    <title>Editar Livro</title>
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
    <form action="/editarLivros/salvarEditar.php" method="POST" class="editar-livro-form">
        <input type="hidden" name="id_livros" readonly value="<?= $id; ?>">
        <label for="titulo">Livro:
            <input type="text" name="titulo" id="titulo" value="<?= $titulo ?>" placeholder="Digite o novo nome para o livro" size="30">
        </label>
        <div>

            <label for="autor">Autor:
                <select id="autor" name="autor" required class="select-autor">
                    <?php
                    $sql = 'select * from autores order by nome';
                    $query = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($query)) {
                        $selected = ($row['nome'] == $autor) ? 'selected' : '';
                        echo "<option value='{$row['id_autores']}' $selected>{$row['nome']}</option>";
                    }
                    ?>
                </select>
            </label>
            <label for="id_categorias">Categoria:
                <select name="id_categorias" id="id_categorias" required class="select-categoria">
                    <?php
                    $sql = "select * from categorias order by categoriaTipo;";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        $selected = ($row['categoriaTipo'] == $categoria) ? 'selected' : '';
                        echo "<option value='{$row['id_categorias']}' $selected>{$row['categoriaTipo']}</option>";
                    }
                    ?>
            </label>
            </select>
        </div>

        <label for="ano">Data de Lançamento
            <input type="date" name="ano" id="ano" value="<?= $ano; ?>">
            <br>
            <br>
            <label class="status">Status:

                <?php
                if ($status === 'i') {
                ?>
                    <input type="radio" name="status" id="statusAtivo" value="a">Ativo</input>
                    <input type="radio" name="status" id="statusInativo" checked value="i">Inativo</input>
            </label>
        <?php
                } else {
        ?>
            <input type="radio" name="status" id="statusAtivo" checked value="a">Ativo</input>
            <input type="radio" name="status" id="statusInativo" value="i">Inativo</input>

        <?php
                }
        ?>
        </label>

        <br>
        <br>
        <input type="submit" name="update" id="update" value="Atualizar">

    </form>

</body>

</html>