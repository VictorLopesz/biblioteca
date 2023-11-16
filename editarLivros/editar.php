<?php
include("../config/conexao.php");

    $pdo = new PDO("mysql:host=127.0.0.1;dbname=biblioteca", 'root', "");
    $id = filter_input(INPUT_POST, "id_livros", FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_input(INPUT_POST, "titulo");
    $autor = filter_input(INPUT_POST, "id_autores");
    $categoria = filter_input(INPUT_POST, "categoriaTipo");
    $ano = filter_input(INPUT_POST, "ano");
    $status = filter_input(INPUT_POST, "status");


    if($id && $titulo && $autor && $categoria && $ano && $status){
        $sql = $pdo->prepare("UPDATE livros SET titulo = :titulo, autor = :id_autores, categoria = :categoriaTipo, ano = :ano, status = :status
        WHERE id = id_livros");
        $sql->bindValue("titulo", $titulo);
        $sql->bindValue("id_autores", $autor);
        $sql->bindValue("categoriaTipo", $categoria);
        $sql->bindValue("ano", $ano);
        $sql->bindValue("status", $status);
        $sql->bindValue("id_livros", $id);
        $sql->execute();
        header("Location: ../PagPesquisa/index.php");
        exit();
    } else {
        header("Location: ../PagPesquisa/index.php");
    };