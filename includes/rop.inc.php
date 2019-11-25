<?php
session_start();
if ($_SESSION['admincheck']!==1) {
  header("Location: ../menu.php?error=ropfinal");
  exit();
}

if (isset($_POST['group-rop-final-submit'])) {

  require 'dbh.inc.php';

  //echo '<br><br>';
  //var_dump($_SESSION['post_data_ropversion']);
  //echo '<br><br>';
  //var_dump($_SESSION['post_data_ropgroup']);

  $_POSTVER = $_SESSION['post_data_ropversion'];
  $ropversion = $_POSTVER['versionrop']; //Versão do ROP
  $ropnumgroup = $_POSTVER['numgrouprop']; //Número de grupos dessa versão

  $_POSTGROUP = $_SESSION['post_data_ropgroup'];
  $ropgroupname = $_POSTGROUP['versionrop']; //Array com os nomes dos grupos
  $ropgroupqtd = $_POSTGROUP['qtd']; //Array da qtde de ROPs desse grupo

  $roplabel = $_POST['rop'];
  $ropclass = $_POST['classrop'];

  //Inserindo os grupos na tabela ropgroup
  for ($i=1; $i <= $ropnumgroup  ; $i++) {
    $sql = "INSERT INTO ropgroup (numGroup, versionGroup, nameGroup, qtropGroup) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
    if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
      header("Location: ../cadastro.php?error=sqlerror"); //Retornará à pag anterior
      exit();
    }
    else { //Se a conexão for bem sucedida, fará a inclusão do numgrouprop
      mysqli_stmt_bind_param($stmt, "iisi", $i, $ropversion, $ropgroupname[$i], $ropgroupqtd[$i]);
      mysqli_stmt_execute($stmt); // Executa o statement
    }
  }


  for ($i=1; $i <= $ropnumgroup  ; $i++) {
    for ($j=1; $j <= $ropgroupqtd[$i]  ; $j++) {
      $sql = "SELECT idGroup FROM ropgroup WHERE versionGroup=? AND nameGroup=?;";
      // Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
      // evitando que o mesmo seja corrompido ou destruído
      $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
      if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
        header("Location: ../new-rop.php?error=sqlerror"); //Retornará à pag anterior
        exit();
      }
      else{ //Se a conexão for bem sucedida, fará a consulta
        mysqli_stmt_bind_param($stmt, "is", $ropversion, $ropgroupname[$i]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)){
          $groupCode = $row['idGroup'];
        }
        if (empty($result)){
          header("Location: ../new-rop.php?error=groupnotfound"); //Retornará à pag anterior
          exit();
        }
        else{//Se depois de todas as verificações e chegou aqui, significa que está tudo ok e fará a inserção
          $sql = "INSERT INTO rop (numRop, versionRop, idGroup, labelRop, classRop) VALUES (?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
          if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
            header("Location: ../new-rop.php?error=sqlerror"); //Retornará à pag anterior
            exit();
          }else{//Se a conexão for bem sucedida, fará a inclusão da rop
            //echo $groupCode;
            mysqli_stmt_bind_param($stmt, "iiisi", $j, $ropversion, $groupCode, $roplabel[$i][$j], $ropclass[$i][$j]);
            mysqli_stmt_execute($stmt); // Executa o statement
            //echo $stmt;
            //header("Location: ../menu.php?rop=success"); //Retorna à pag anterior com sucesso
          }//FIM linha 39
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  /*
  var_dump($_POST);
  echo '<br><br>';
  for ($i=1; $i <= $ropnumgroup; $i++) {
    for ($j=1; $j <= $ropgroupqtd[$i]; $j++) {
      echo 'i=['.$i.'] e j=['.$j.'] = '.$ropclass[$i][$j].'<br><br>';
      // code...
    }
  }*/
  header("Location: ../menu.php?rop=success"); //Retorna à pag anterior com sucesso
  exit();


}else { //Se chegou nessa pág de forma ilegal ou erronea (que não tenha sido pelo button)
  //Será expulso dessa pág retornando à pág que deveria ter vindo.
  header("Location: ../new-rop.php");
  exit();
}
