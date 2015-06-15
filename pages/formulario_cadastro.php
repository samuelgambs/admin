<?php 
include "functions.php";
require_once('../includes/mysqli.php');
error_reporting(0);

$sql_socios = "SELECT DISTINCT idSocio, Nome FROM ap_socios WHERE suporteadm = 'n' ORDER BY Nome ASC;";
$res_socios = $MySQLi->query($sql_socios) OR trigger_error($MySQLi->error, E_USER_ERROR);

$sql_admin = "SELECT DISTINCT  idSocio, Nome FROM ap_socios WHERE suporteadm = 's' ORDER BY Nome ASC;";
$res_admin = $MySQLi->query($sql_admin) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num_admin = mysqli_num_rows($res_admin);
$tipo_user = $_GET["tipouser"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<title>Formulário Cadastro</title>
<style type="text/css">
<!--
body {
	background-color: #CCCCCC;
}
-->
</style>
  <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" style="margin-top:0">
                   
                    <div class="panel-body">
                       <strong>Tipo:</strong>
                       <form name="cadastro" id="cadastro" method="post" action="cadastra.php" id="group">
                       <input name="tipo" type="radio" value="socio" class="socio" id="socio" />Sócio
                       <?php if ($tipo_user!=7) { ?>
                       <input name="tipo" type="radio" value="administrador" class="admin" id="admin" />Administrador 
                       <?php }?>
                       <br />
                       
      <div id="socios_div" class="administradores" style="padding-top: 5px; padding-right:10px;display:none">

                     <strong>Sócio:</strong>
                        <select name="socios" id="socios" class="form-control" style="width:200px">
                         Selecione...
                      
              <?php   // Faz um loop, passando por todos os resultados encontrados
                                while ($dados_socios = $res_socios->fetch_object()) {
                                ?>
                  <option value="<?php echo $dados_socios->idSocio; ?>"> <?php echo $dados_socios->Nome; ?></option>
                
                 

                      <?php } ?>
            </select>
            </div>
<br />
      <div id="administradores_div" class="administradores" style="padding-top: 5px; padding-right:10px;display:none">
                     <strong>Usuário Administrativo: </strong>
                        <select name="administradores" id="administradores" class="form-control" style="width:200px">
                         Selecione...
                        
                             <?php   // Faz um loop, passando por todos os resultados encontrados
                                    while ($dados_admin = $res_admin->fetch_object()) {
                                    ?>
                         <option value="<?php echo $dados_admin->idSocio; ?>"> <?php echo $dados_admin->Nome; ?></option>

                            <?php } ?>
                        </select>
                  </div>
                  <br />
					<strong>Email:</strong><br>
					<input name="email" type="text" id="email" /><br />
					<br />
					<strong>Senha:</strong><br /> 
					<input name="senha" type="text" id="senha"  /><br />
					<br />
					<br />
					<input type="hidden" name="tipo_usuario" id="tipo_usuario" value=""></input>
					<input type="hidden" name="tipo_usuario_logado" id="tipo_usuario_logado" value="<?php echo $tipo_user?>"></input>
					
					<input type="submit" name="Submit" class="btn btn-success" value="Enviar"  />
					
					</form>

                    </div>
                </div>
            </div>
   


	
   <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script>
  
    
    $('#admin').click(function() {
        $("#administradores_div").toggle(this.checked);
        $("#socios_div").hide('slow');
        $("#tipo_usuario").val('7');
    });
    $('#socio').click(function() {
        $("#socios_div").toggle(this.checked);
        $("#administradores_div").hide('slow');
        $("#tipo_usuario").val('6');
    });
      
      
    </script>
</body>
</html>
