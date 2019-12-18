<?php
  require "header2.php";
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
?>
  <title> Menu Sistema | Sistema HcA </title>
  <link rel="stylesheet" href="css/menustyle.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <main>

    <div class="services-section">
      <div class="inner-width">
        <h2 class="section-title"><label class="backbtn" onclick="goBack()"><i class="fas fa-angle-left"></i></label> Menu sistema</h2>
	      <br>
        <div class="border"></div>
        <?php /* LINKS */
          $linksetores = "window.location.href='menu.sys.setores.php'";
          $linkusersrmv = "window.location.href='#'";
          $linkusers = "window.location.href='#'";
        ?>
        <!-- AREA DO SUPER ADMINISTRADOR -->
        <?php
          if ($_SESSION['admincheck']==7){
            echo '<h2 class="section-date">Super administrador<h2>';
            $cadastrolink = "window.location.href='cadastro.php'";
            $cadastrolink = "window.location.href='cadastro.php'";
            $newroplink = "window.location.href='new-rop.php'";
        ?>
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $cadastrolink; ?> ">
              <i class="fas fa-code"></i>
            </div>
            <p class="title">BLOCK Alterar páginas</p>
            <p class="desc">Number one</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $cadastrolink; ?> ">
              <i class="fas fa-database"></i>
            </div>
            <p class="title">BLOCK Banco de Dados</p>
            <p class="desc">Number two</p>
          </div>
          <!--div class="service-box">
            <div class="service-icon" onclick=" <?php echo $newroplink; ?> ">
              <i class="fas fa-calendar-check"></i>
            </div>
            <p class="title">???</p>
            <p class="desc">Number three</p>
          </div-->
        </section>
        <div class="border"></div>
      <?php } ?>
        <!-- FIM DA AREA DO SUPER ADMINISTRADOR -->
        <!-- ÁREA COMUM -->
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick="<?php echo $linksetores; ?>">
              <i class="fas fa-laptop-code"></i>
            </div>
            <p class="title">BLOCK Geral</p>
            <p class="desc">Números do sistema</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick="<?php echo $linksetores; ?>">
              <i class="fas fa-clinic-medical"></i>
            </div>
            <p class="title">BLOCK Setores</p>
            <p class="desc">Gerenciar setores</p>
          </div>
          <!--div class="service-box">
            <div class="service-icon" onclick=" <?php echo $newroplink; ?> ">
              <i class="fas fa-unlock-alt"></i>
            </div>
            <p class="title">Alterar senha</p>
            <p class="desc">Alterar a senha do usuário</p>
          </div-->
        </section>
        <!-- FIM ÁREA COMUM -->

      </div> <!-- FIM div class="inner-width" -->
    </div> <!-- FIM div class="services-section"-->
  </main>
  <script>
    function goBack() {
      window.history.go(-1);
    }
  </script>
