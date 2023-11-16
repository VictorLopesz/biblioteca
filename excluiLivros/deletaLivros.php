<?php
include('../config/conexao.php');


if(isset($_GET['id']) && !empty($_GET['id'])){

    $query = "DELETE from livros where id_livros = " .$_GET['id'];
    $resultado = mysqli_query($conn, $query);

    if($resultado){
        header("Location: ../PagPesquisa/index.php?mensagem=Livro excluido com sucesso");
        exit();
    } else {
        header("Location: ../PagPesquisa/index.php?mensagem=Erro ao excluir livro");
    };

}
else{
    header("Location: ../PagPesquisa/index.php?mensagem=Selecione um livro para apagar");
    exit();
};

?>