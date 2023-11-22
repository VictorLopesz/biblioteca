<?php
include("../config/conexao.php");

// Verificação se o parâmetro Update existe/se foi definido
if (isset($_POST["update"])) {
    // Atualiza as opções nas variáveis abaixo
    $id = $_POST["id_livros"];
    $titulo = $_POST["titulo"];
    $ano = $_POST["ano"];
    $autor = $_POST["autor"];
    $idCategoria = $_POST["id_categorias"];
    $status = $_POST["status"];

    // Atualização na tabela livros
    $sqlUpdateLivros = "UPDATE livros SET titulo = '$titulo', ano = '$ano', autor = '$autor', status = '$status'
                            WHERE id_livros = $id";

    // Executa a atualização na tabela livros
    $resultUpdateLivros = $conn->query($sqlUpdateLivros);

    if ($resultUpdateLivros) {
        // Atualização bem-sucedida, agora atualize a tabela de ligação livro_categoria
        $sqlUpdateLivroCategoria = "UPDATE livro_categoria SET id_categorias = '$idCategoria'
        WHERE id_livros = $id";

        // Executa a atualização na tabela livro_categoria
        $resultUpdateLivroCategoria = $conn->query($sqlUpdateLivroCategoria);

        if ($resultUpdateLivroCategoria) {
            // Atualização bem-sucedida na tabela livro_categoria
            header('Location: ../PagPesquisa/index.php?mensagem=item atualizado com sucesso');
        } else {
            // Erro na atualização da tabela livro_categoria
            echo "Erro ao atualizar na tabela livro_categoria: " . $conn->error;
        }
    } else {
        // Erro na atualização da tabela livros
        echo "Erro ao atualizar na tabela livros: " . $conn->error;
    }
} else {
    // O parâmetro Update não foi definido, retornar para a página de pesquisa
    header('Location: ../PagPesquisa/index.php');
}
