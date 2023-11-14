<?php
include('../config/conexao.php');

if(!empty($_GET['id']))
{
    $id = $_GET['id'];

    $mysqli = "SELECT * FROM livros WHERE id=$id";

    $result = $conn ->query($mysqli);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row["id"];
        }
    }
};