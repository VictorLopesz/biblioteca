<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="./gravarLivro.php" method="POST">
            <h3>CADASTRAR LIVROS</h3>
            <?= isset($_GET['texto']) ? $_GET['texto'] : "" ?>
            <div>
                <label for="nome">Nome do livro:</label>
                <input name="titulo" id="titulo" type="text" placeholder="Digite o nome livro" size="30" required>
            </div>
            <br>
            <div>
                <label for="">Nome do autor:</label>
                <input name="autor" id="autor" type="text" placeholder="Digite o nome do Autor" size="30" required>
            </div>
            <div>
                <br>
                <label for="">Nacionalidade:</label>
                <input name="nacionalidade" id="nacionalidade" type="text" placeholder="Digite a nacionalidade do Autor" size="30" required>
            </div>
            <br>
            <div>
                <label for="">Categoria:</label>
                <select id="nome" name="nome" required>
                    <option value="" selected></option>
                    <option value="comedia">Comédia</option>
                    <option value="terror">Terror</option>
                    <option value="Acao">Ação</option>
                    <option value="ficcao">Ficção</option>
                    <option value="drama">Drama</option>
                    <option value="tragedia">Tragédia</option>
                    <option value="autobiografico">Autobiografico</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Autoajuda">Autoajuda</option>
                </select>
            </div>
            <br>
            <div>
                <label for="">Data de Lançamento:</label>
                <input type="date" id="ano" name="ano" required>
            </div>
            <br>
            <div>
                <label for="">Status:</label>
                <input type="radio" id="ativo" name="status" value="a">
                <label for="ativo">Ativo</label><br>
                <input type="radio" id="inativo" name="status" value="i">
                <label for="inativo">Inativo</label><br>
            </div>
            <br>
            <input type='submit' name="cadastrar">
        </form>
        <br>
        <div>
            <a href="../PagPesquisa/index.php">Página de Pesquisa</a>
        </div>
    </div>
</body>

</html>