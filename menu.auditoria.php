<?php
  require "header2.php";
  //Essa verificação parece redundante, mas eu acho que deixa uma segurança Maior
  //Não tem como ser diferente de 0 e 1, a menos que tenha acessado de forma ilegal.
  //Sendo 1 ou 0, significa que está logado. Tem outras maneiras de se fazer isso,
  //Mas esse foi o mais simples que pensei neste momento
  if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  }
  require 'includes/dbh.inc.php';

  /// CÓDIGO QUE BUSCA OS SETORES
  $sql = "SELECT * FROM setor WHERE stateSetor=1";
  $stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
  if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
		header("Location: menu.auditoria.php?error=connectionerror"); //Retornará à pag anterior
		exit();
	}
	else{ //Se a conexão for bem sucedida, fará a consulta
		mysqli_stmt_execute($stmt);
		$resultSetor = mysqli_stmt_get_result($stmt);
		$j = 1;
		while ($rowRop = mysqli_fetch_assoc($resultSetor)){
			$idSetor[$j] = $rowRop['idSetor'];
			$uidSetor[$j] = $rowRop['uidSetor'];
			$j ++;
		}//fim while
  }




	// CÓDIGO QUE BUSCA A ÚLTIMA VERSÃO
	//$sql = "SELECT Max(versionrop) FROM rop;";
	$sql = "SELECT versiongroup FROM ropgroup ORDER BY versiongroup DESC LIMIT 1;";
	// Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
	// evitando que o mesmo seja corrompido ou destruído
	$stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
	if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
		header("Location: menu.auditoria.php?error=connectionerror"); //Retornará à pag anterior
		exit();
	}
	else{ //Se a conexão for bem sucedida, fará a consulta
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_assoc($result)){
			$version = $row['versiongroup'];
		}//fim while
	}
	if ( empty($version) ){
		$sql = "SELECT versionrop FROM rop ORDER BY versionrop DESC LIMIT 1;";
		// Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
		// evitando que o mesmo seja corrompido ou destruído
		$stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
		if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
			header("Location: menu.auditoria.php?error=sqlerror"); //Retornará à pag anterior
			exit();
		}
		else{ //Se a conexão for bem sucedida, fará a consulta
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)){
				$version = $row['versionrop'];
			}//fim while
		}
	}
	if ( empty($version) ){
		header("Location: menu.auditoria.php?error=sqlerror"); //Retornará à pag anterior
		exit();
	}
	// FIM CÓDIGO QUE BUSCA A ÚLTIMA VERSÃO

	// CÓDIGO QUE BUSCA E CALCULA O NÚMERO DE GRUPOS DA ÚLTIMA VERSÃO
	$sql = "SELECT idGroup FROM ropgroup WHERE versionGroup=?;";
	// Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
	// evitando que o mesmo seja corrompido ou destruído
	$stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
	if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
		header("Location: menu.auditoria.php?error=sqlerror"); //Retornará à pag anterior
		exit();
	}
	else{ //Se a conexão for bem sucedida, fará a verificação
		mysqli_stmt_bind_param($stmt, "s", $version);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		// A variável $resultCheck armazena a qtde de linha que retornou da consulta
		$resultCheck = mysqli_stmt_num_rows($stmt);
	}//FIM CÓDIGO QUE BUSCA E CALCULA O NÚMERO DE GRUPOS DA ÚLTIMA VERSÃO

	// CÓDIGO QUE BUSCA O NUM A QTDE DE ROPS DE CADA GRUPO
	$sql = "SELECT idGroup, nameGroup, numGroup, qtropGroup FROM ropgroup WHERE versionGroup=?;";
	// Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
	// evitando que o mesmo seja corrompido ou destruído
	$stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
	if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
		header("Location: menu.auditoria.php?error=sqlerror"); //Retornará à pag anterior
		exit();
	}
	else{ //Se a conexão for bem sucedida, fará a consulta
		mysqli_stmt_bind_param($stmt, "s", $version);
		mysqli_stmt_execute($stmt);
		$resultGroup = mysqli_stmt_get_result($stmt);
		/*
		while ($row = mysqli_fetch_assoc($result)){
			echo '<br><br>';
			var_dump($result);
			echo '<br>';
			var_dump($row);
			echo '<br>';
			echo $row['idGroup'];
			echo $row['nameGroup'];
			echo $row['numGroup'];
			echo $row['qtropGroup'];
		}//fim while
		*/
	}
	// FIM CÓDIGO QUE BUSCA O NUM A QTDE DE ROPS DE CADA GRUPO

	// CÓDIGO QUE BUSCA AS ROPS DA ÚLTIMA VERSÃO
	$sql = "SELECT idRop, numRop, versionRop, idGroup, labelRop, classRop FROM rop WHERE versionRop=?;";
	// Esse ? é uma questão de segurança para ngm injetar código SQL dentro do nosso banco
	// evitando que o mesmo seja corrompido ou destruído
	$stmt = mysqli_stmt_init($conn); //Aqui faz a conexão com o banco
	if (!mysqli_stmt_prepare($stmt, $sql)) { //Se houver algum erro de sql
		header("Location: menu.auditoria.php?error=sqlerror"); //Retornará à pag anterior
		exit();
	}
	else{ //Se a conexão for bem sucedida, fará a consulta
		mysqli_stmt_bind_param($stmt, "s", $version);
		mysqli_stmt_execute($stmt);
		$resultRop = mysqli_stmt_get_result($stmt);
		$j = 1;
		while ($rowRop = mysqli_fetch_assoc($resultRop)){
			$idRop[$j] = $rowRop['idRop'];
			$numRop[$j] = $rowRop['numRop'];
			$versionRop[$j] = $rowRop['versionRop'];
			$idGroupRop[$j] = $rowRop['idGroup'];
			$labelRop[$j] = $rowRop['labelRop'];
			$classRop[$j] = $rowRop['classRop'];
			$j ++;
			/*
			echo $idRop[$j]; echo '<br>';
			echo $numRop[$j] ; echo '<br>';
			echo $versionRop[$j]; echo '<br>';
			echo $idGroupRop[$j]; echo '<br>';
			echo $labelRop[$j]; echo '<br>';
			echo $classRop[$j]; echo '<br>';
			echo '<br>';echo '<br>';
			*/
		}//fim while

	}
	// FIM CÓDIGO QUE BUSCA AS ROPS DE UMA DADA VERSÃO

	$i = 1;
	while ($row = mysqli_fetch_assoc($resultGroup)){
		//echo '<br><br>';
		//var_dump($resultGroup);
		//echo '<br>';
		//var_dump($row);
		$idGroup[$i] = $row['idGroup'];
		$nameGroup[$i] = $row['nameGroup'];
		$numGroup[$i] = $row['numGroup'];
		$qtropGroup[$i] = $row['qtropGroup'];
		/*echo $idGroup[$i];
		echo $nameGroup[$i];
		echo $numGroup[$i];
		echo $qtropGroup[$i];*/
		$i = $i +1;
	}//fim while
  unset($_SESSION['idRop']); $_SESSION['idRop'] = $idRop;
  unset($_SESSION['classRop']); $_SESSION['classRop'] = $classRop;
  unset($_SESSION['idGroup']); $_SESSION['idGroup'] = $idGroup;
  unset($_SESSION['numGroupID']); $_SESSION['numGroupID'] = $numGroup;
  unset($_SESSION['qtropGroup']); $_SESSION['qtropGroup'] = $qtropGroup;

  // CÓDIGO PARA ARMAZENAR O DATETIME AO INICIAR A AUDITORIA
  try{
      $DT = new DateTime( 'now', new DateTimeZone( 'America/Sao_Paulo') );
  }catch( Exception $e )
  {
      echo 'Erro ao instanciar objeto.';
      echo $e->getMessage();
      exit();
  }
  // FIM DO CODIGO DATETIME

  // VARIÁVEIS AUXILIARES PARA O form
  $countRop = 0;

  // TRATAMENTO DE MENSAGEM NO http_build_url
  $msg = "";
  if (isset($_GET['emptySetor']) || isset($_GET['error'])) {
    if ($_GET['emptySetor']=="") {
      $msg = "O setor não pode ser vazio.";
    }else
    {
      if ($_GET['error']=="sqlerror") {
        $msg = "Erro com o banco de dados, por favor tente mais tarde.";
      }
    }
  }
  if (isset($_GET['success'])){
    $msg = "Auditoria realizada com sucesso.";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title> Auditoria | Sistema HcA </title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/audit2style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style type="text/css">
		.main-content{background-color: rgba(255, 255, 255, 0.7); padding-top:00px;padding-bottom: 0px;}
		.row{margin:10px 0px;}
	</style>

</head>
<body>

<form action="includes/audit.inc.php" method="post">
  <div class="container main-content">
  	<div class="login2"><h2>Auditoria</h2></div>
    <div class="content" display="flex">
    	<div class="row">
    		<div class="col-md-11">
    			<h5>
            <p><label> Versão: <?php echo $version; ?> <input type="hidden" name="version" value="<?php echo $version; ?>"> <input type="hidden" name="startAudit" value="<?php echo $DT->format('Y-m-d H:i:s'); ?>"></label></p>
            <p><label> Grupos: <?php echo $resultCheck; ?> <input type="hidden" name="uidfullUser" value="<?php echo $_SESSION['userUid']. " " . $_SESSION['userLastUid']; ?>"></label></p>
            <?php
              echo "<div class='select'>";
                echo "<select name='setor' id='setor'>";
                  echo "<option selected disabled>Selecione o setor</option>";
                  for ($i=1; $i<=sizeof($uidSetor); $i++){
                    echo "<option value=".$i.">".$uidSetor[$i]."</option>";
                  }
                echo "</select>";
              echo "</div>";

              /*echo "<select name=setor>";
              echo "<option value=''>Selecione o setor</option>";
              for ($i=1; $i<=sizeof($uidSetor); $i++){
                echo "<option value=".$i.">".$uidSetor[$i]."</option>";
              }
              echo "</select>";*/
              ?>

            <?php if ($msg!==""){ ?><p><label> <?php echo $msg; ?> </label></p> <?php } ?>

          </h5>
    		</div>
    	</div>
    </div>
  </div>

  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="panel-g" id="accordion" role="tablist" aria-multiselectable="true">
                  <?php for ($i=1; $i <= $resultCheck; $i++) { ?>
                  <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="heading<?php echo $i ; ?>">
                          <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ; ?>" <?php if ($i==1){ echo "aria-expanded='true'"; } else { echo "class='collapsed' aria-expanded='false'"; } ?> aria-controls="collapse<?php echo $i ; ?>">
                                  Grupo <?php echo $numGroup[$i]; ?>: <?php echo $nameGroup[$i]; ?>
                              </a>
                          </h4>
                      </div><!-- FIM DO CABEÇALHO DO GRUPO -->


                      <div id="collapse<?php echo $i ; ?>" <?php if ($i==1){ echo "class='panel-collapse collapse in'"; } else { echo "class='panel-collapse collapse'"; } ?> role="tabpanel" aria-labelledby="heading<?php echo $i ; ?>">
                          <div class="panel-body">
                            <?php for ($j=1; $j <= $qtropGroup[$i]; $j++) { ?>
                              <?php $countRop++ ?>
                              <div id="example-<?php echo $numGroup[$i];?><?php echo $j;?>" class="content" display="flex">
                                <div class="row">
                                  <div class="col-md-12"><button type="button" id="btnAdd-<?php echo $numGroup[$i];?><?php echo $j;?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                                  <?php echo $numGroup[$i];?>.<?php echo $j;?>. <?php echo $labelRop[$countRop]; ?>
                                  </div>
                                </div>
                                <div class="row group">
                                  <div class="col-md-12">
                                    <div class="row">
                                        <button type="button" class="btn btn-danger btnRemove btn-sm"><i class="fas fa-minus"></i></button>
                                        <!--div class="btn-g" -->
                                            <label class="btn btn-default btn-g" data-toggle="buttons">
                                                <input class="btn-g" type="radio" id="rop<?php echo $i; echo $j; ?>[0]" name="rop<?php echo$i.$j;?>[0]" value="C">Conforme
                                            </label>
                                            <label class="btn btn-default btn-g" data-toggle="buttons">
                                                <input class="btn-g" type="radio" id="rop<?php echo $i; echo $j; ?>[0]" name="rop<?php echo$i.$j;?>[0]" value="NC" >Não conforme
                                            </label>
                                            <label class="btn btn-default btn-g" data-toggle="buttons">
                                                <input class="btn-g" type="radio" id="rop<?php echo $i; echo $j; ?>[0]" name="rop<?php echo$i.$j;?>[0]" value="P">Parcial
                                            </label>
                                            <label class="btn btn-default btn-g" data-toggle="buttons">
                                                <input class="btn-g" type="radio" id="rop<?php echo $i; echo $j; ?>[0]" name="rop<?php echo$i.$j;?>[0]" value="NA" checked>Não aplica
                                            </label>
                                        <!--/div-->
                                        <label><input class="form-control" type="text"  name="info<?php echo $i; echo $j; ?>[]" placeholder="Informação"></label>
                                      </div>
                                  </div>
                                </div>
                              </div>

                            <?php } ?>
                          </div>
                      </div>

                  </div>
                <?php } ?>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingComment">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseComment" aria-expanded="false" aria-controls="collapseComment">
                                Comentário
                            </a>
                        </h4>
                    </div>
                    <div id="collapseComment" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingComment">
                        <div class="panel-body">
                          <div class="form-g">
                            Insira um comentário sobre esta auditoria (opcional):
                            <textarea class="form-control" id="inputlg" type="textarea" rows="2" name="comment" placeholder="Insira o seu comentário aqui."></textarea>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="panel-heading" align="center">
                      <button class="btn btn-lg" type="submit" name="auditoria-submit">Gravar auditoria</button>
                </div><!-- FIM DO CABEÇALHO DO GRUPO -->
              </div>
          </div>
      </div>

  </div>

  </form>

<!-- https://stackoverflow.com/questions/19102946/bootstrap-radio-button-checked-flag -->
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery Multifield -->
<script src="js/jquery.multifield.js"></script>
<script>
	<?php for ($i=1; $i <= $resultCheck; $i++) { ?>
		<?php for ($j=1; $j <= $qtropGroup[$i]; $j++) { ?>
			$('#example-<?php echo $numGroup[$i];?><?php echo $j;?>').multifield({
				section: '.group',
				btnAdd:'#btnAdd-<?php echo $numGroup[$i];?><?php echo $j;?>',
				btnRemove:'.btnRemove'
			});
		<?php
		}?>

	<?php
	} /* FOR $i dos Grupos */?>
</script>

<!-- Place this tag right after the last button or just before your close body tag. -->
<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
