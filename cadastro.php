<?php
  require "header2.php";
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
?>
  <title> Cadastro de Usuário | Sistema HcA </title>
  <link rel="stylesheet" href="css/cadastrostyle.css">

<main>
  <div class="login">
    <h1>Cadastro de Usuário</h1>
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
      <form class="" action="includes/signup.inc.php" method="post">
        <div class="textbox">
          <i class="fas fa-user"></i>
          <input type="text" name="uid" placeholder="Nome *" autocomplete="new-password">
        </div>

        <div class="textbox">
          <i class="fas fa-user-friends"></i>
          <input type="text" name="uidlast" placeholder="Sobrenome *">
        </div>

        <div class="textbox">
          <i class="fas fa-birthday-cake"></i>
          <input type="text" name="birthdayuid" placeholder="Data de Nascimento">
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
          <i class="fas fa-user-shield"/></i>
          <label class="container"> Administrador? *
            <input type="checkbox" name="checkadmin">
            <span class="checkmark"></span>
          </label>
        </div>

        <button class="btn" type="submit" name="signup-submit">Cadastrar</button>
        <!--<input type="button" class="btn" value="Cadastrar" onclick="window.location.href='menu.php'">-->
    </form>
  </div>

</main>
