<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "auditoriahca";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn){
  die("Conexão com o banco de dados falhou. Código do erro: ". mysqli_connect_error());
}
