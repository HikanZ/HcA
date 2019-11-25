<?php
  require "header2.php";
  if ($_SESSION['admincheck']!==1) {
    header("Location: menu.php");
    exit();
  }
  if (isset($_POST['group-rop-submit'])) {
    require 'includes/dbh.inc.php';
    $_POSTOLD = $_SESSION['post_data_rop'];

    $_SESSION['post_data_ropversion'] = $_SESSION['post_data_rop'];
    $_SESSION['post_data_ropgroup'] = $_POST;
    //echo '<br><br>';
    //var_dump($_SESSION['post_data_ropversion']);
    //echo '<br><br>';
    //var_dump($_SESSION['post_data_ropgroup']);
    $ropversion = $_POSTOLD['versionrop'];
    $ropnumgroup = $_POSTOLD['numgrouprop'];
    $ropgroupname = $_POST['versionrop'];
    $ropgroupqtd = $_POST['qtd'];
    for ($i=1; $i <= $ropnumgroup  ; $i++) {
      if ( empty($ropgroupname[$i]) || empty($ropgroupqtd[$i]) ){
        header("Location: new-rop-group.php?error=emptyfields");
        exit();
      }
    }

  }else{
    header("Location: new-rop-group.php?error=emptypost");
    exit();
  }

?>
  <script src="js/rop-app.js"></script>
  <title> Cadastro de ROP | Sistema HcA </title>
  <link rel="stylesheet" href="css/newropstyle.css">

<main>
  <div class="login2">
    <?php
        echo '<h1>Cadastro de ROP ver.['.$ropversion.']</h1>';
    ?>
    <form class="" action="includes/rop.inc.php" method="post">
        <div>
          <?php
            for ($i=1; $i <= $ropnumgroup  ; $i++) {
              echo'<div class="textbox">';
              echo '<h2>Grupo '.$i.': '.$ropgroupname[$i].' </h2>';
              echo'</div>';
              for ($j=1; $j <= $ropgroupqtd[$i]  ; $j++){
                echo'<div class="textbox2">';
                echo'<label>'.$i.'.'.$j.'.</label>';
                echo'<textarea class="i2" name="rop['.$i.']['.$j.']" cols="80" rows="3" placeholder="Descrição da ROP '.$i.'.'.$j.'"></textarea>';
                //echo'  <input class="i2" type="text" name="versionrop['.$i.']" placeholder="Descrição da ROP '.$i.'.'.$j.'">';

                //$nomeRadio = "classrop".$i.$j;
                ?>
                <p>
                  <input type="radio" id="test1<?php echo $i; echo $j; ?>" name="classrop[<?php echo $i; ?>][<?php echo $j; ?>]" value=1>
                  <label for="test1<?php echo $i; echo $j; ?>">Maior</label>
                </p>
                <p>
                  <input type="radio" id="test2<?php echo $i; echo $j; ?>" name="classrop[<?php echo $i; ?>][<?php echo $j; ?>]" value=0>
                  <label for="test2<?php echo $i; echo $j; ?>">Menor</label>
                </p>
                <?php
                echo'</div>';
              }//for $j
            }//for $i

          ?>
      </div>
        <button class="btn" type="submit" name="group-rop-final-submit">Inserir ROPs (3/3)</button>
    </form>
  </div>

</main>
