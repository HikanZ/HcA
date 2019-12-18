<?php
  require "header2.php";
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
?>
  <title> Menu | Sistema HcA </title>
  <link rel="stylesheet" href="css/menustyle.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <main>

    <div class="services-section">
      <div class="inner-width">
        <h2 class="section-title">Bem vindo, <?php echo $_SESSION['userUid']; ?> </h2>
	       <br>
	      <h2 class="section-date"> <label id="dayweek"></label>, <label id="day"></label> de <label id="month"></label> de <label id="year"></label>
        <script>
          var d = new Date();
          var days = ["Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado"];
          document.getElementById("dayweek").innerHTML = days[d.getDay()];
          document.getElementById("day").innerHTML = d.getDate();
          var months = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
          document.getElementById("month").innerHTML = months[d.getMonth()];
          document.getElementById("year").innerHTML = d.getFullYear();
        </script>
        </h2>
        <h2 class="section-login-info"> Este é o seu login nº, <?php echo $_SESSION['countLogin']?>. <br>Seu último login foi em <?php echo $_SESSION['lastLogin']?>.</h2>


        <div class="border"></div>
        <?php
          $linkusers = "window.location.href='menu.users.php'";
          $linksystem = "window.location.href='menu.sys.php'";
          $newroplink = "window.location.href='new-rop.php'";
          $linkauditoria ="window.location.href='menu.auditoria.php'";
          $linkrelatorio = "window.location.href='menu.report.php'";
        ?>
        <!-- AREA DO ADMINISTRADOR -->
        <?php
          if ($_SESSION['admincheck']==1 || $_SESSION['admincheck']==7){
            echo '<h2 class="section-date">Área de administrador<h2>';

        ?>
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linkusers; ?> ">
              <i class="fas fa-users"></i>
            </div>
            <p class="title">Usuários</p>
            <p class="desc">Gerenciar usuários</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linksystem; ?> ">
              <i class="fas fa-laptop-code"></i>
            </div>
            <p class="title">BLOCK Sistema</p>
            <p class="desc">Gerenciar sistema e setores</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $newroplink; ?> ">
              <i class="fas fa-calendar-check"></i>
            </div>
            <p class="title">BLOCK ROP</p>
            <p class="desc">Gerenciar ROPs</p>
          </div>
        </section>
        <div class="border"></div>
      <?php } ?>
        <!-- FIM DA AREA DO ADMINISTRADOR -->
        <!-- ÁREA COMUM -->
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick="<?php echo $linkauditoria; ?>">
              <i class="fas fa-tasks"></i>
            </div>
            <p class="title">Check-list</p>
            <p class="desc">Iniciar auditoria</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linkrelatorio; ?> " >
              <i class="fas fa-chart-pie"></i>
            </div>
            <p class="title">Relatório</p>
            <p class="desc">Visão geral, gráficos e relatórios das auditorias</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $newroplink; ?> ">
              <i class="fas fa-user-edit"></i>
            </div>
            <p class="title">BLOCK Minha conta</p>
            <p class="desc">Gerenciar minha conta</p>
          </div>
        </section>
        <!-- FIM ÁREA COMUM -->

      </div> <!-- FIM div class="inner-width" -->
    </div> <!-- FIM div class="services-section"-->
  </main>
