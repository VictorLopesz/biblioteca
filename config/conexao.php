<?php

$hostname = "127.0.0.1";
$dbname = "biblioteca";
$username = "root";
$password = "";

$conn = new mysqli($hostname, $username, $password, $dbname );
if ($conn->connect_errno) {
    echo "Conexão falhou: (" . $conn->connect_errno . ")" . $conn->connect_errno;
}

?>