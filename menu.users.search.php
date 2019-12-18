<?php
  require "header2.php";
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
  if ($_SESSION['admincheck']!==1 && $_SESSION['admincheck']!==7) {
    header("Location: index.php");
    exit();
  }

  $msg = "Os campos marcados com * não podem ser vazios";
  $msgerror = 0;
  if (isset($_GET['error']) ) {
      if ($_GET['error'] == "emptyfields") {
        $msg = "Preencha todos os campos marcados com *.";
        $msgerror = 1;
      }
      else if ($_GET['error'] == "invalidmail") {
        $msg = "Email inválido.";
        $msgerror = 1;
      }
      else if ($_GET['error'] == "passwordcheck") {
        $msg = "As senhas precisam ser identicas.";
        $msgerror = 1;
      }
      else if ($_GET['error'] == "emailtaken") {
        $msg = "Email já cadastrado. Deseja reativar a conta?";
        $msgerror = 1;
      }
  }else{
    if ( isset($_GET['signup']) ){
      if ($_GET['signup']=="success") {
        $msg = "Cadastrado com sucesso";
        $msgerror = 0;
      }
    }else $msg = "";
  }

?>
<title> Pesquisar Usuário | Sistema HcA </title>
<link rel="stylesheet" href="css/cadastrostyle.css">

<main>
  <div class="login">
    <h1><label class="backbtn" onclick="goBack()"><i class="fas fa-angle-left"></i></label> Pesquisar Usuário</h1>
      <h2><?php
        if ($msgerror == 1){ ?>
          <p class="signuperror"> <?php echo $msg; ?> </p><br>
        <?php
      }else{ ?>
        <p class="signupsuccess"> <?php echo $msg; ?> </p><br>
      <?php
      }
    ?></h2>
      <form class="" action="includes/signup.inc.php" method="post">
        <div class="textbox">
          <i class="fas fa-user"></i>
          <input type="text" name="fieldsearch" placeholder="Insira o campo de pesquisa aqui.">
        </div>

        <div class="radio-group">
          <label class="btn btn-default btn-g"  data-toggle="buttons" checked="checked">
              <input class="btn-g" type="radio" id="search" name="search" value="C">Nome
          </label>
          <label class="btn btn-default btn-g" data-toggle="buttons" >
              <input class="btn-g" type="radio" id="search" name="search" value="V">Sobrenome
          </label>
          <label class="btn btn-default btn-g" data-toggle="buttons" >
              <input class="btn-g" type="radio" id="search" name="search" value="B">Cargo
          </label>
          <label class="btn btn-default btn-g" data-toggle="buttons" >
              <input class="btn-g" type="radio" id="search" name="search" value="R">Email
          </label>
        </div>

        <button class="btnsearch" type="submit" name="signup-submit"><i class="fas fa-search"></i></button>
        <!--<input type="button" class="btn" value="Cadastrar" onclick="window.location.href='menu.php'">-->
    </form>
  </div>

</main>

<script>
  function goBack() {
    window.history.go(-1);
  }
</script>
