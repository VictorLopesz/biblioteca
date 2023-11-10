<?php

$hostname = "127.0.0.1";
$dbname = "biblioteca";
$username = "root";
$password = "";

$mysqli = new mysqli($hostname, $username, $password, $dbname );
if ($mysqli->connect_errno) {
    echo "Conexão falhou: (" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
}
?>