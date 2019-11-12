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


        <div class="border"></div>
        <!-- AREA DO ADMINISTRADOR -->
        <?php
          if ($_SESSION['admincheck']==1){
            echo '<h2 class="section-date">Área de administrador<h2>';
            $cadastrolink = "window.location.href='cadastro.php'";
            $cadastrolink = "window.location.href='cadastro.php'";
            $newroplink = "window.location.href='new-rop.php'";
        ?>
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $cadastrolink; ?> ">
              <i class="fas fa-user-plus"></i>
            </div>
            <p class="title">Novo usuário</p>
            <p class="desc">Adicionar usuário</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $cadastrolink; ?> ">
              <i class="fas fa-user-times"></i>
            </div>
            <p class="title">Remover usuário</p>
            <p class="desc">Excluir usuário</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $newroplink; ?> ">
              <i class="fas fa-calendar-check"></i>
            </div>
            <p class="title">Novo ROP</p>
            <p class="desc">Nova versão do ROP</p>
          </div>
        </section>
        <div class="border"></div>
      <?php } ?>
        <!-- FIM DA AREA DO ADMINISTRADOR -->
        <!-- ÁREA COMUM -->
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick="window.location.href='audit.php'">
              <i class="fas fa-tasks"></i>
            </div>
            <p class="title">Check-list</p>
            <p class="desc">Iniciar auditoria</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick="window.location.href='#'">
              <i class="fas fa-chart-pie"></i>
            </div>
            <p class="title">Visão Geral</p>
            <p class="desc">Visão geral, gráficos e relatórios das auditorias</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $newroplink; ?> ">
              <i class="fas fa-unlock-alt"></i>
            </div>
            <p class="title">Alterar senha</p>
            <p class="desc">Alterar a senha do usuário</p>
          </div>
        </section>
        <!-- FIM ÁREA COMUM -->

      </div> <!-- FIM div class="inner-width" -->
    </div> <!-- FIM div class="services-section"-->
  </main>
