<?php
  //Chama a barra de navegação superior
  require "header2.php";
  //Se uma sessão já estiver iniciada, ou seja, alguém já estiver logado
  if (isset($_SESSION['userId'])) {
    header("Location: menu.php"); //encaminhará automaticamente para o menu principal.
    exit(); // e encerra evitando qualquer carregamento e consumo desnecessário de banda.
  }
?>
  <title> Login | Sistema HcA </title>
  <link rel="stylesheet" href="css/indexstyle.css">

  <main>
    <div class="wrapper-main">
      <div class="d1">
        <!--img src="img/logo.png" alt="" /-->
      </div>
      <div class="login">
        <form class="" action="includes/login.inc.php" method="post">
          <h1>Login</h1>
          <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="text" name="loginmail" placeholder="Email">
          </div>

          <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" name="loginpwd" placeholder="Senha" autocomplete="new-password">
          </div>
          <button class="btn" type="submit" name="login2-submit">Entrar</button>
        </form>
      </div>



    </div>

    <!--
    <div class="wrapper-main">
      <div class="d1">
        <img src="img/logo.png">

      </div>
      <div class="login">
        <form class="" action="includes/login.inc.php" method="post">
          <h1>Login</h1>

        <div class="textbox">
          <i class="fas fa-user"></i>
          <input type="text" name="loginmail" placeholder="Email" autocomplete="new-password">
        </div>

        <div class="textbox">
          <i class="fas fa-lock"></i>
          <input type="password" name="loginpwd" placeholder="Senha" autocomplete="new-password">
        </div>
        <button class="btn" type="submit" name="login2-submit">Entrar</button>
        </form>
      </div>
    </div>
  -->

  </main>
