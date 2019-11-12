<?php
  require "header2.php";
  if ($_SESSION['admincheck']!==1) {
    header("Location: menu.php");
    exit();
  }

  if (isset($_POST['group2-submit'])) {
    require 'includes/dbh.inc.php';
    $ropversion = $_POST['versionrop'];
    $ropnumgroup = $_POST['numgrouprop'];
    if ( empty($ropversion) || empty($ropnumgroup) ){
      header("Location: new-rop.php?error=emptyfields&versionrop=".$ropversion."&numgrouprop=".$ropnumgroup);
      exit();
    }
    else{
      $sql = "SELECT versionGroup FROM ropgroup WHERE versionGroup=?";
      // Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
      // evitando que o mesmo seja corrompido ou destruído
      $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
      if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
        header("Location: new-rop.php?error=sqlerror"); //Retornará à pag anterior
        exit();
      }
      else { //Se a conexão for bem sucedida, fará a verificação
        mysqli_stmt_bind_param($stmt, "s", $ropversion);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        // A variável $resultCheck armazena a qtde de linha que retornou da consulta
        $resultCheck = mysqli_stmt_num_rows($stmt);
        // Se houver mais do que 0 resultados (ou seja 1 ou mais)
        // Significa que o email já foi utilizado, retornando à pag anterior
        if ($resultCheck > 0) {
          header("Location: new-rop.php?error=versiontaken");
          exit();
        }
      }
    }
    unset($_SESSION['post_data_rop']);
    $_SESSION['post_data_rop'] = $_POST;

  }else{ //Se a var $_POST estiver vazio, não veio do submit correto, VAZA DAQUI!
    header("Location: new-rop.php?error=emptypost");
    exit();
  }

?>
  <title> Cadastro de Grupo | Sistema HcA </title>
  <link rel="stylesheet" href="css/newropstyle.css">

<main>
  <div class="login">
    <?php
        echo '<h1>Cadastro de Grupos ver.['.$ropversion.']</h1>';
    ?>
      <form class="" action="new-rop-group-final.php" method="post">
        <?php
          for ($i=1; $i <= $ropnumgroup  ; $i++) {
            echo'<div class="textbox">';
            echo'  <input type="text" name="versionrop['.$i.']" placeholder="Insira o título do grupo '.$i.'">';
            echo'  <input type="text" name="qtd['.$i.']" placeholder="Número de ROP do grupo'.$i.'">';
            echo'</div>';
          }
        ?>
        <button class="btn" type="submit" name="group-rop-submit">Próxima etapa (2/3)</button>
      </form>
  </div>

</main>
