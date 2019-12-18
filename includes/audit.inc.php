<?php
session_start();
if ($_SESSION['admincheck']!==1 && $_SESSION['admincheck']!==0 && $_SESSION['admincheck']!==7) {
  header("Location: ../menu.php");
  exit();
}

//Verifica se chegou nessa page a aprtir do submit da auditoria
if (isset($_POST['auditoria-submit'])) {
  if (empty($_POST['setor'])){
    header("Location: ../menu.auditoria.php?emptySetor");
    exit();
  }
  require 'dbh.inc.php';
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

  $sql = "INSERT INTO audit (idUsers, uidfullUsers, idSetor, versionRop, commentAudit, startAudit, endAudit) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
  if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
    //header("Location: ../cadastro.php?error=sqlerror"); //Retornará à pag anterior
    exit();
  }
  else { //Se a conexão for bem sucedida, fará a inclusão do numgrouprop
    mysqli_stmt_bind_param($stmt, "isiisss", $idUsers, $uidUsers, $idSetor, $versionRop, $commentAudit, $startAudit, $endAudit);
    mysqli_stmt_execute($stmt); // Executa o statement
  }
  $sql = "SELECT idAudit FROM audit WHERE (idUsers=? AND uidfullUsers=? AND idSetor=? AND versionRop=? AND startAudit=? AND endAudit=?);";
  $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
  if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
    header("Location: ../cadastro.php?error=sqlerror"); //Retornará à pag anterior
    exit();
  }
  else { //Se a conexão for bem sucedida, fará a inclusão do numgrouprop
    mysqli_stmt_bind_param($stmt, "isiiss", $idUsers, $uidUsers, $idSetor, $versionRop, $startAudit, $endAudit);
    mysqli_stmt_execute($stmt); // Executa o statement
    $resultRop = mysqli_stmt_get_result($stmt);
  }
  $rowAudit = mysqli_fetch_assoc($resultRop);
  $idAudit = $rowAudit['idAudit'];

  $idRop = $_SESSION['idRop'];
  $classRop = $_SESSION['classRop'];
  $idGroup = $_SESSION['idGroup'];
  $numGroup = $_SESSION['numGroupID'];
  $qtropGroup = $_SESSION['qtropGroup'];
  var_dump($_POST);
  echo "<br><br>";
  $i = 1; $j = 2;
  var_dump($_POST["rop".$i.$j]);

  $countRop = 1;
  for ($i = 1; $i<= sizeof($numGroup); $i++){
    for ($j = 1; $j<=$qtropGroup[$i]; $j++ ){
      echo "<br>Grupo ".$i. " Rop ". $j .": ";
      $arr_lenght = count($_POST["rop".$i.$j]);
      echo $arr_lenght.": ";
      $k2 = 0;
      for ($k = 0; $k < $arr_lenght; $k++){
        while(empty($_POST["rop".$i.$j][$k2])){$k2++;}
        echo $k2.': ';
        echo $_POST["rop".$i.$j][$k2]." ";
        $sql = "INSERT INTO answer (idAudit, idRop, idGroup, numGroup, numRop, classRop, resultAnswer, infoAnswer) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
        if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
          header("Location: ../menu.auditoria.php?error=sqlerror"); //Retornará à pag anterior
          exit();
        }else{//Se a conexão for bem sucedida, fará a inclusão da rop
          //echo $groupCode;
          mysqli_stmt_bind_param($stmt, "iiiiiiss", $idAudit, $idRop[$countRop], $idGroup[$i], $i, $j, $classRop[$countRop], $_POST["rop".$i.$j][$k2], $_POST["info".$i.$j][$k]);
          mysqli_stmt_execute($stmt); // Executa o statement
        }
        $k2++;
      }//FIM FOR k
      $countRop++;
    }//FIM FOR j
  }//FIM FOR i







  //Limpar as variáveis da sessão -> Descomentar qdo terminar
  /*unset($_SESSION['idRop']);
  unset($_SESSION['classRop']);
  unset($_SESSION['idGroup']);
  unset($_SESSION['numGroupID']);
  unset($_SESSION['qtropGroup']); */
// else do if isset $_POST
}else { //Se chegou nessa pág de forma ilegal ou erronea (que não tenha sido pelo button)
  //Será expulso dessa pág retornando à pág que deveria ter vindo.
  header("Location: ../menu.auditoria.php");
  exit();
}
