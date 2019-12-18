<?php
  require "header2.php";
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
  if ($_SESSION['admincheck']!==1 && $_SESSION['admincheck']!==7) {
    header("Location: ../index.php");
    exit();
  }

  $msg = "Os campos marcados com * não podem ser vazios.";
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
        $msg = "Cadastrado com sucesso.";
        $msgerror = 0;
      }
    }else $msg = "Os campos marcados com * não podem ser vazios.";
  }

?>
  <title> Cadastro de Usuário | Sistema HcA </title>
  <link rel="stylesheet" href="css/cadastrostyle.css">

<main>
  <div class="login">
    <h1><label class="backbtn" onclick="goBack()"><i class="fas fa-angle-left"></i></label> Cadastro de Usuário</h1>
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
          <input type="text" name="uid" placeholder="Nome *">
        </div>

        <div class="textbox">
          <i class="fas fa-user-friends"></i>
          <input type="text" name="uidlast" placeholder="Sobrenome *">
        </div>

        <div class="textbox">
          <i class="fas fa-birthday-cake"></i>
          <input type="date" name="birthdayuid" placeholder="Data de Nascimento *">
        </div>

        <div class="textbox">
          <i class="fas fa-envelope"></i>
          <input type="text" name="mail" placeholder="Email *">
        </div>

        <div class="textbox">
          <i class="fas fa-lock"></i>
          <input type="password" name="pwd" placeholder="Senha *" autocomplete="new-password">
        </div>

        <div class="textbox">
          <i class="fas fa-lock"></i>
          <input type="password" name="pwd-repeat" placeholder="Repita a senha *">
        </div>

        <div class="textbox">
          <i class="fas fa-user-tie"></i>
          <input type="text" name="functionuid" placeholder="Cargo">
        </div>

        <div class="textbox">
          <i class="fas fa-user-tie"></i>
          <input type="text" name="cpfUser" placeholder="CPF">
        </div>

        <div class="textbox">
          <i class="fas fa-user-shield"/></i>
          <label class="container adm"> Administrador? *
            <input type="checkbox" name="checkadmin">
            <span class="checkmark"></span>
          </label>
        </div>

        <button class="btn" type="submit" name="signup-submit">Cadastrar</button>
        <!--<input type="button" class="btn" value="Cadastrar" onclick="window.location.href='menu.php'">-->
    </form>
  </div>

</main>

<script>
  function goBack() {
    window.history.go(-1);
  }
</script>
