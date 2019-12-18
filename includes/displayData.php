<?php
session_start();
try{
    $DT = new DateTime( 'now', new DateTimeZone( 'America/Sao_Paulo') );
}catch( Exception $e )
{
    echo 'Erro ao instanciar objeto.';
    echo $e->getMessage();
    exit();
}
echo "<br>";
echo $DT->format('Y-m-d H:i:s');
echo "<br><br>";

$idUsers = $_SESSION['userId'];
$uidUsers = $_POST['uidfullUser'];
$idSetor = $_POST['setor'];
$versionRop = $_POST['version'];
$startAudit = $_POST['startAudit'];
$endAudit = $DT->format('Y-m-d H:i:s');
$commentAudit = $_POST['comment'];

echo $idUsers; echo "<br>";
echo $uidUsers; echo "<br>";
echo $idSetor; echo "<br>";
echo $versionRop; echo "<br>";
echo $startAudit; echo "<br>";
echo $endAudit; echo "<br>";
echo $commentAudit; echo "<br>";

echo "<br>";
var_dump($_POST);

?>
