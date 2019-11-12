<?php
if (isset($_POST['login2-submit'])) {
  //Verifica se alguem chegou nessa página sem que tenha sido pelo submit do botão do login
  //Se chegou por aqui pelo botão, tudo bem, executará o código abaixo
  //Detalhe que as funções exit garante que se houver um erro terminará a execução no momento
  //Evitando que haja a conexão e execução de forma ilegal ou erronea.

  require 'dbh.inc.php';
  $mailuid = $_POST['loginmail'];
  $password2 = $_POST['loginpwd'];
  //$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';

  if (empty($mailuid) || empty($password2)){
    var_dump($password2);
    echo $mailuid;
    echo $password2;
    if (!empty($mailuid) )
      header("Location: ../index.php?error=loginemptyfields&loginmail=".$mailuid);
    else
      header("Location: ../index.php?error=loginemptyfields");
    exit();
  }// FIM if (empty($mailuid) || empty($password)){
  else {
    $sql = "SELECT * FROM users WHERE emailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
      header("Location: ../index.php?error=sqlerror"); //Retornará à pag anterior
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password2, $row['pwdUsers']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpwd"); //Retornará à pag anterior
          exit();
        }
        else if ($pwdCheck == true) {
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUid'] = $row['uidUsers'];
          $_SESSION['admincheck'] = $row['adminSystem'];
          header("Location: ../menu.php?login=success"); //Retornará à pag anterior
          exit();
        }else {
          header("Location: ../index.php?error=nouser"); //Retornará à pag anterior
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser"); //Retornará à pag anterior
        exit();
      }
    }
  }

}
else{//Se chegou nessa pág de forma ilegal ou erronea (que não tenha sido pelo button)
  //Será expulso dessa pág retornando à pág que deveria ter vindo.
  header("Location: ../index.php");
  exit();

}
