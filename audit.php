<?php
  require "header2.php";
  //Essa verificação parece redundante, mas eu acho que deixa uma segurança Maior
  //Não tem como ser diferente de 0 e 1, a menos que tenha acessado de forma ilegal.
  //Sendo 1 ou 0, significa que está logado. Tem outras maneiras de se fazer isso,
  //Mas esse foi o mais simples que pensei neste momento
  if ($_SESSION['admincheck']!==1 && $_SESSION['admincheck']!==0 ) {
    header("Location: menu.php");
    exit();
  }
  require 'includes/dbh.inc.php';
?>
  <script src="js/rop-app.js"></script>
  <title> Auditoria | Sistema HcA </title>
  <link rel="stylesheet" href="css/auditstyle.css">

<main>
  <div class="login2">
    <?php
        //echo '<h1>Cadastro de ROP ver.['.$ropversion.']</h1>';
        echo '<div><h1>Auditoria</h1></div>';

        // CÓDIGO QUE BUSCA A ÚLTIMA VERSÃO
        //$sql = "SELECT Max(versionrop) FROM rop;";
        $sql = "SELECT versiongroup FROM ropgroup ORDER BY versiongroup DESC LIMIT 1;";
        // Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
        // evitando que o mesmo seja corrompido ou destruído
        $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
        if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
          header("Location: audit.php?error=connectionerror"); //Retornará à pag anterior
          exit();
        }
        else{ //Se a conexão for bem sucedida, fará a consulta
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)){
            $version = $row['versiongroup'];
          }//fim while
        }
        if ( empty($version) ){
          $sql = "SELECT versionrop FROM rop ORDER BY versionrop DESC LIMIT 1;";
          // Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
          // evitando que o mesmo seja corrompido ou destruído
          $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
          if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
            header("Location: audit.php?error=sqlerror"); //Retornará à pag anterior
            exit();
          }
          else{ //Se a conexão for bem sucedida, fará a consulta
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)){
              $version = $row['versionrop'];
            }//fim while
          }
        }
        if ( empty($version) ){
          header("Location: audit.php?error=sqlerror"); //Retornará à pag anterior
          exit();
        }
        // FIM CÓDIGO QUE BUSCA A ÚLTIMA VERSÃO

        // CÓDIGO QUE BUSCA E CALCULA O NÚMERO DE GRUPOS DA ÚLTIMA VERSÃO
        $sql = "SELECT idGroup FROM ropgroup WHERE versionGroup=?;";
        // Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
        // evitando que o mesmo seja corrompido ou destruído
        $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
        if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
          header("Location: audit.php?error=sqlerror"); //Retornará à pag anterior
          exit();
        }
        else{ //Se a conexão for bem sucedida, fará a verificação
          mysqli_stmt_bind_param($stmt, "s", $version);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          // A variável $resultCheck armazena a qtde de linha que retornou da consulta
          $resultCheck = mysqli_stmt_num_rows($stmt);
        }//FIM CÓDIGO QUE BUSCA E CALCULA O NÚMERO DE GRUPOS DA ÚLTIMA VERSÃO

        // CÓDIGO QUE BUSCA O NUM A QTDE DE ROPS DE CADA GRUPO
        $sql = "SELECT idGroup, nameGroup, numGroup, qtropGroup FROM ropgroup WHERE versionGroup=?;";
        // Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
        // evitando que o mesmo seja corrompido ou destruído
        $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
        if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
          header("Location: audit.php?error=sqlerror"); //Retornará à pag anterior
          exit();
        }
        else{ //Se a conexão for bem sucedida, fará a consulta
          mysqli_stmt_bind_param($stmt, "s", $version);
          mysqli_stmt_execute($stmt);
          $resultGroup = mysqli_stmt_get_result($stmt);
          /*
          while ($row = mysqli_fetch_assoc($result)){
            echo '<br><br>';
            var_dump($result);
            echo '<br>';
            var_dump($row);
            echo '<br>';
            echo $row['idGroup'];
            echo $row['nameGroup'];
            echo $row['numGroup'];
            echo $row['qtropGroup'];
          }//fim while
          */
        }
        // FIM CÓDIGO QUE BUSCA O NUM A QTDE DE ROPS DE CADA GRUPO

        // CÓDIGO QUE BUSCA AS ROPS DA ÚLTIMA VERSÃO
        $sql = "SELECT idRop, numRop, versionRop, idGroup, labelRop, classRop FROM rop WHERE versionRop=?;";
        // Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
        // evitando que o mesmo seja corrompido ou destruído
        $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
        if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
          header("Location: audit.php?error=sqlerror"); //Retornará à pag anterior
          exit();
        }
        else{ //Se a conexão for bem sucedida, fará a consulta
          mysqli_stmt_bind_param($stmt, "s", $version);
          mysqli_stmt_execute($stmt);
          $resultRop = mysqli_stmt_get_result($stmt);
          $j = 1;
          while ($rowRop = mysqli_fetch_assoc($resultRop)){
            $idRop[$j] = $rowRop['idRop'];
            $numRop[$j] = $rowRop['numRop'];
            $versionRop[$j] = $rowRop['versionRop'];
            $idGroupRop[$j] = $rowRop['idGroup'];
            $labelRop[$j] = $rowRop['labelRop'];
            $classRop[$j] = $rowRop['classRop'];
            $j ++;
            /*
            echo $idRop[$j]; echo '<br>';
            echo $numRop[$j] ; echo '<br>';
            echo $versionRop[$j]; echo '<br>';
            echo $idGroupRop[$j]; echo '<br>';
            echo $labelRop[$j]; echo '<br>';
            echo $classRop[$j]; echo '<br>';
            echo '<br>';echo '<br>';
            */
          }//fim while

        }
        // FIM CÓDIGO QUE BUSCA AS ROPS DE UMA DADA VERSÃO

        $i = 1;
        while ($row = mysqli_fetch_assoc($resultGroup)){
          //echo '<br><br>';
          //var_dump($resultGroup);
          //echo '<br>';
          //var_dump($row);
          echo '<br>';
          $idGroup[$i] = $row['idGroup'];
          $nameGroup[$i] = $row['nameGroup'];
          $numGroup[$i] = $row['numGroup'];
          $qtropGroup[$i] = $row['qtropGroup'];
          /*echo $idGroup[$i];
          echo $nameGroup[$i];
          echo $numGroup[$i];
          echo $qtropGroup[$i];*/
          $i = $i +1;
        }//fim while


    ?>

    <div class="textbox2">
      <p>
        <label> Versão: </label>
        <label> <?php echo $version; ?></label>
      </p>
      <p>
        <label> Grupos: </label>
        <label> <?php echo $resultCheck; ?></label>
      </p>
    </div>
    <div class="border-admin"></div>
    <div class="textbox">
        <?php for ($i=1; $i <= $resultCheck; $i++) { ?>
          <div class="textboxup">
          </div>
          <p>
            <label class="group"> <b> Grupo <?php echo $numGroup[$i]; ?>: </b> </label>
            <label class="group"> <b> <?php echo $nameGroup[$i]; ?> </b> </label>
          </p>
          <?php for ($j=1; $j <= $qtropGroup[$i]; $j++) { ?>
            <div class="textboxin">
              <p>
                <label class="container">
                  <input type="checkbox" name="checkadmin">
                  <span class="checkmark"></span>
                </label>
                <label class="roptitle"><?php echo $numGroup[$i];?>.<?php echo $numRop[$j];?>. </label>
                <label class="rop"> <?php echo $labelRop[$j]; ?></label>
              </p>
            </div>



          <?php
          }?>
          <br>
        <?php
        } ?>
    </div>
    <form class="" action="includes/audit.inc.php" method="post">

      <button class="btn" type="submit" name="audit-submit">Gravar auditoria</button>
    </form>
  </div>

</main>
