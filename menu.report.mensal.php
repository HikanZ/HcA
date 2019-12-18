<?php
  require "header2.php";
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
  if ($_SESSION['admincheck']!==1 && $_SESSION['admincheck']!==7 && $_SESSION['admincheck']!==0) {
    header("Location: index.php");
    exit();
  }
  require 'includes/dbh.inc.php';

  /// CÓDIGO QUE BUSCA OS SETORES
  $sql = "SELECT * FROM setor WHERE stateSetor=1";
  $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
  if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
    header("Location: menu.auditoria.php?error=connectionerror"); //Retornará à pag anterior
    exit();
  }
  else{ //Se a conexão for bem sucedida, fará a consulta
    mysqli_stmt_execute($stmt);
    $resultSetor = mysqli_stmt_get_result($stmt);
    $j = 1;
    while ($rowRop = mysqli_fetch_assoc($resultSetor)){
      $idSetor[$j] = $rowRop['idSetor'];
      $uidSetor[$j] = $rowRop['uidSetor'];
      $j ++;
    }//fim while
  }
?>


<html lang="pt-br">
<head>
  <title> Relatório | Sistema HcA </title>
  <link rel="stylesheet" href="css/cadastrostyle.css">
</head>

<body>
  <div class="login">
    <h1><label class="backbtn" onclick="goBack()"><i class="fas fa-angle-left"></i></label> Relatório Mensal</h1>

    <form class="" action="includes/get.report.php" method="post">

      <div class="textbox">
        <i class="fas fa-calendar-minus"></i>
        <input type="text" name="ano" placeholder="Digite o ano *">
      </div>

      <div class="textbox">
        <i class="fas fa-calendar-alt"></i>
        <div class="select">
          <select name="mes" id="mes">
            <option selected disabled>Escolha o mês</option>
            <option value="01">Janeiro</option>
            <option value="02">Fevereiro</option>
            <option value="03">Março</option>
            <option value="04">Abril</option>
            <option value="05">Maio</option>
            <option value="06">Junho</option>
            <option value="07">Julho</option>
            <option value="08">Agosto</option>
            <option value="09">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
          </select>
        </div>
      </div>

      <div class="textbox">
        <i class="fas fa-hospital-alt"></i>
        <div class='select'>
          <select name='setor' id='setor'>
            <option selected disabled>Selecione o setor</option>
            <?php
            for ($i=1; $i<=sizeof($uidSetor); $i++){
              echo "<option value=".$i.">".$uidSetor[$i]."</option>";
            } ?>
          </select>
        </div>
      </div>

      <button class="btn" type="submit" name="signup-submit">Gerar relatório</button>
      <!--<input type="button" class="btn" value="Cadastrar" onclick="window.location.href='menu.php'">-->
  </form>
  </div>

</body>
<script>
  function goBack() {
    window.history.go(-1);
  }
</script>
