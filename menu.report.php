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

    // LINKS
    $link1 = "window.location.href='#'";
    $link2 = "window.location.href='menu.report.mensal.php'";
    $link3 = "window.location.href='menu.report.tempo.php'";
?>
<html>
  <head>
    <title> Menu Relatórios | Sistema HcA </title>
    <link rel="stylesheet" href="css/menustyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  </head>
  <body>
    <div class="services-section">
      <div class="inner-width">
        <h2 class="section-title"><label class="backbtn" onclick="goBack()"><i class="fas fa-angle-left"></i></label> Menu Relatórios</h2>
         <br>

        <div class="border"></div>


        <!-- ÁREA COMUM -->
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick="<?php echo $link1; ?>">
              <i class="fas fa-clipboard-list"></i>
            </div>
            <p class="title">BLOCK Auditorias</p>
            <p class="desc">Lista todas as auditorias</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $link2; ?> ">
              <i class="fas fa-calendar-alt"></i>
            </div>
            <p class="title">Relatório Mensal</p>
            <p class="desc">Relatório mensal das auditorias</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $link3; ?> ">
              <i class="fas fa-calendar-day"></i>
            </div>
            <p class="title">Relatório Período</p>
            <p class="desc">Relatório das auditorias em um período determinado</p>
          </div>
          <!--div class="service-box">
            <div class="service-icon" onclick="<?php echo $linkusers; ?>">
              <i class="fas fa-user-times"></i>
            </div>
            <p class="title">Remover</p>
            <p class="desc">Desativar conta</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linkusers; ?> ">
              <i class="fas fa-user-check"></i>
            </div>
            <p class="title">Ativar conta</p>
            <p class="desc">Reativar uma conta</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linkusers; ?> ">
              <i class="fas fa-user-edit"></i>
            </div>
            <p class="title">Editar conta</p>
            <p class="desc">Alterar dados cadastrados</p>
          </div-->
        </section>
        <!-- FIM ÁREA COMUM -->

      </div> <!-- FIM div class="inner-width" -->
    </div> <!-- FIM div class="services-section"-->


  </body>

</html>
<!-- SCRIPTS -->
<script>
  function goBack() {
    window.history.go(-1);
  }
</script>
