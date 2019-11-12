<?php
  require "header2.php";
  if ($_SESSION['admincheck']!==1) {
    header("Location: index.php");
    exit();
  }
?>
  <title> Cadastro de Versão | Sistema HcA </title>
  <link rel="stylesheet" href="css/newropstyle.css">

<main>
  <div class="login1">
    <h1>Cadastro de Versão</h1>
      <h2> <?php
      /*
        if (isset($_GET[''])) {
          if ($_GET['signup']=="success") {
            echo '<p class="signupsuccess"> Cadastrado com sucesso</p>';
          }
          else if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
              echo '<p class="signuperror"> Preencha todos os campos marcados com ( * )</p>';
            }
            else if ($_GET['error'] == "invalidmail") {
              echo '<p class="signuperror"> E-mail inválido</p>';
            }
            else if ($_GET['error'] == "passwordcheck") {
              echo '<p class="signuperror"> As senhas precisam ser idênticas</p>';
            }
            else if ($_GET['error'] == "emailtaken") {
              echo '<p class="signuperror"> E-mail já cadastrado</p>';
            }
          }
        }else echo "Os campos marcados não podem ser vazios";
    */
    ?> </h2>
      <form class="" action="new-rop-group.php" method="post">
        <div class="textbox">
          <input class="i2" type="number" name="versionrop" placeholder="Insira a versão (ano) [aaaa] *">
        </div>

        <div class="textbox">
          <input class="i2" type="number" name="numgrouprop" placeholder="Insira a quantidade de grupos *">
        </div>

        <button class="btn" type="submit" name="group2-submit">Próxima etapa (1/3)</button>
    </form>
  </div>

</main>
