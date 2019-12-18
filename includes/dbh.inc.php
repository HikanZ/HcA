<?php

/*$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "hca";*/
/*$dBName = "auditoriahca";*/


$servername = "us-cdbr-iron-east-05.cleardb.net";
$dBUsername = "bf4c680fa2b474";
$dBPassword = "44085d68";
$dBName = "heroku_b1e74900a9ac80d";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn){
  die("Conexão com o banco de dados falhou. Código do erro: ". mysqli_connect_error());
}
