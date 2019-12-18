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
  $linkusersadd = "window.location.href='menu.users.add.php'";
  $linkuserssearch = "window.location.href='menu.users.search.php'";
  $linkuserslist = "window.location.href='#'";
?>
  <title> Menu Sistema | Sistema HcA </title>
  <link rel="stylesheet" href="css/menustyle.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <main>

    <div class="services-section">
      <div class="inner-width">
        <h2 class="section-title"><label class="backbtn" onclick="goBack()"><i class="fas fa-angle-left"></i></label> Menu usuários</h2>
	       <br>

        <div class="border"></div>

        <!-- AREA DO SUPER ADMINISTRADOR -->
        <?php
          if ($_SESSION['admincheck']==5){
            echo '<h2 class="section-date">Super administrador<h2>';
            $linkusersadd = "window.location.href='menu.users.add.php'";
            $cadastrolink = "window.location.href='cadastro.php'";
            $newroplink = "window.location.href='new-rop.php'";
        ?>
        <section class="flex">
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linkusers; ?> ">
              <i class="fas fa-code"></i>
            </div>
            <p class="title">BLOCK Alterar páginas</p>
            <p class="desc">Number one</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linkusers; ?> ">
              <i class="fas fa-database"></i>
            </div>
            <p class="title">BLOCK Banco de Dados</p>
            <p class="desc">Number two</p>
          </div>
          <!--div class="service-box">
            <div class="service-icon" onclick=" <?php //echo $linkusers; ?> ">
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
            <div class="service-icon" onclick="<?php echo $linkusersadd; ?>">
              <i class="fas fa-user-plus"></i>
            </div>
            <p class="title">Adicionar Usuário</p>
            <p class="desc">Cadastrar novo auditor</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linkuserssearch; ?> ">
              <i class="fas fa-search"></i>
            </div>
            <p class="title">BLOCK Pesquisar Usuário</p>
            <p class="desc">Procurar e gerenciar usuários</p>
          </div>
          <div class="service-box">
            <div class="service-icon" onclick=" <?php echo $linkuserslist; ?> ">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <p class="title">BLOCK Listar Usuário</p>
            <p class="desc">Gerar uma lista de todos os usuários</p>
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
  </main>

  <script>
    function goBack() {
      window.history.go(-1);
    }
  </script>
