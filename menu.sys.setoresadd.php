<?php
  require "header2.php";
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
?>
  <title> Cadastro de Setor | Sistema HcA </title>
  <link rel="stylesheet" href="css/cadastrostyle.css">

<main>
  <div class="login">
    <h1>Cadastro de Setor</h1>
      <h2><?php
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
    ?></h2>
      <form class="" action="includes/setoradd.inc.php" method="post">
        <div class="textbox">
          <i class="fas fa-clinic-medical"></i>
          <input type="text" name="uidsetor" placeholder="Setor *" autocomplete="new-password">
        </div>

        <button class="btn" type="submit" name="signup-submit">Cadastrar</button>
        <!--<input type="button" class="btn" value="Cadastrar" onclick="window.location.href='menu.php'">-->
    </form>
  </div>

</main>
