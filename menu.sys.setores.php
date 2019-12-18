<?php
  require "header2.php";
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
?>
  <title> Menu Setores | Sistema HcA </title>
  <link rel="stylesheet" href="css/menustyle.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <main>

    <div class="services-section">
      <div class="inner-width">
        <h2 class="section-title"><label class="backbtn" onclick="goBack()"><i class="fas fa-angle-left"></i></label> Menu setores</h2>
	       <br>

        <div class="border"></div>
        <!-- ÁREA COMUM -->
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick="window.location.href='setoresadd.php'">
              <i class="fas fa-plus-circle"></i>
            </div>
            <p class="title">Adicionar setor</p>
            <p class="desc"></p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick="window.location.href='setores.php'">
              <i class="fas fa-minus-circle"></i>
            </div>
            <p class="title">Remover setor</p>
            <p class="desc"></p>
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
