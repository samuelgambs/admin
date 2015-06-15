<?php

session_start();

include "functions.php";

session_checker();
/*echo "Bem vindo <strong>". $_SESSION['nome'] ." </strong>! <br />
	Você est&aacute; acessando &aacute;rea restrita para usu&aacute;rios cadastrados!<br /><br />";

echo "Seu n&iacute;vel de usu&aacute;rio &eacute; <strong>". $_SESSION['nivel_usuario']."</strong>.<br />
Com esse n&iacute;vel, voc&ecirc; tem permis&atilde;o de acesso &agrave; algumas &aacute;reas exclusivas do site.<br /><br />";
echo $_SESSION['IdUser'] ;
//echo $_SESSION['descricao'];
echo $_SESSION['cod_usuario'] ;
*/
$idsocio = $_SESSION['IdUser'];

// Inclui o arquivo que faz a conexão ao banco de dados
require_once('../includes/mysqli.php');
error_reporting(E_ALL);

$sql_regional = "SELECT DISTINCT  Estado FROM ap_clinicas WHERE Estado is not null ORDER BY Estado ASC ;";
$res = $MySQLi->query($sql_regional) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num = mysqli_num_rows($res);

$sql_socios = "SELECT DISTINCT  idSocio, Nome FROM ap_socios WHERE suporteadm='N' ORDER BY Nome ASC;";
$res_socios = $MySQLi->query($sql_socios) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num_socios = mysqli_num_rows($res_socios);

$sql_admin = "SELECT DISTINCT  idSocio, Nome FROM ap_socios WHERE suporteadm='S' ORDER BY Nome ASC;";
$res_admin = $MySQLi->query($sql_admin) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num_admin = mysqli_num_rows($res_admin);

?>
<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rede Odonto</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../css/dataTables.colVis.css">
    <link rel="stylesheet" type="text/css" href="../css/dataTables.fixedColumns.css">
    <link rel="stylesheet" type="text/css" href="../css/shCore.css">
    <link rel="stylesheet" type="text/css" href="../css/multiple-select.css">
    <!-- <link rel="stylesheet" type="text/css" href="../../../examples/resources/demo.css"> -->
    <style type="text/css" class="init">

    /* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 1280px;
        margin: 10 auto;
        margin-top: 20px;
    }
    </style>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="../js/dataTables.colVis.js"></script>
    <script type="text/javascript" language="javascript" src="../js/dataTables.fixedColumns.js"></script>
    <script type="text/javascript" language="javascript" src="../js/shCore.js"></script>
    <script type="text/javascript" language="javascript" src="../js/demo.js"></script>

</head>

<body style="background-color:#FFF" >
    <div id="wrapper" style="margin:0">
        <!-- Navigation -->
       <?php // include '../includes/navigation.php';?>
        <!-- Page Content -->
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" >
                        <h1 class="page-header">Listagem de Clínicas</h1>
                        <div id="regional" style="float:left;padding-bottom: 20px; padding-right:10px">
                                            <label>Filtrar por Regional:</label>
                                            <select name="estado" id="estado" class="form-control" style="width:200px" multiple="multiple"  >

                                            <?php   // Faz um loop, passando por todos os resultados encontrados
                                            while ($dados = $res->fetch_object()) {
                                            ?>
                                              <option><?php echo $dados->Estado; ?></option>

                                            <?php } ?>
                                             </select>
                        </div>
                    <div id="socios_div" class="socios" style="float:left;padding-top: 5px; padding-right:10px; padding-left:10px">
                     <strong>Sócios:</strong>
                        <select name="socios" id="socios" class="form-control" style="width:200px">
                         Selecione...
                        <option> Todos </option>
              <?php   // Faz um loop, passando por todos os resultados encontrados
                                while ($dados_socios = $res_socios->fetch_object()) {
                                ?>
                  <option value="<?php echo $dados_socios->idSocio; ?>"> <?php echo $dados_socios->Nome; ?></option>

                      <?php } ?>
            </select>
                  </div>

                   <div id="administradores_div" class="administradores" style="float:left;padding-top: 5px; padding-right:10px">
                     <strong>Administradores:</strong>
                        <select name="administradores" id="administradores" class="form-control" style="width:200px">
                         Selecione...
                         <option> Todos </option>
                             <?php   // Faz um loop, passando por todos os resultados encontrados
                                    while ($dados_admin = $res_admin->fetch_object()) {
                                    ?>
                         <option value="<?php echo $dados_admin->idSocio; ?>"> <?php echo $dados_admin->Nome; ?></option>

                            <?php } ?>
                        </select>
                  </div>
                                        <div class="form-group" style="float:left;padding-right:10px;margin:5px;display:none">
                                            <label>Tipo de Dados:</label><br>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline2" id="optionsRadiosInline1" value="ma" checked disabled="">Mês Atual
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline2" id="optionsRadiosInline2" value="mp" disabled="">Mês Passado
                                            </label>
                                        </div>

                                        <div class="form-group" style="float:left;padding-right:10px;margin:5px;display:none">
                                            <label>Tipo de Busca:</label><br>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="simplificado.php" checked>Simplificada
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="clinicas.php">Completa
                                            </label>
                                        </div>


            <div style="float: left;padding-top: 20px;  padding-top: 25px;">
            <button onclick="carregaGridClinicas()" class="btn btn-success" id="filtrar">Filtrar</button><br>
            </div>

            <div id="wait" style="display:block;width:69px;height:89px;position:relative;top:150px;left:50%;padding:2px;z-index:10"><img src='loading.gif' width="53" height="53" align="right" /><br>
              Carregando...</div>
            <div id="divTabelaClinicas"></div>
               <!-- Modal  cadastro usuarios -->
                            <div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="width: 300px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Cadastro de Usuários</h4>
                                        </div>
     										 <iframe src="" frameborder="0" width="100%" height="400px"></iframe>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="button_close" name="button_close" >Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script language="javascript">

    $(document).ready(function(){
         $("#divTabelaClinicas").on("click", function(){
            $("#teste").slideUp(300);
        });
          $("#socios").on("click", function(){
            $("#teste").slideUp(300);
        });


       <?php
    		    if ($_SESSION['cod_usuario'] == 6)
    		    	echo "$('#administradores_div').hide('slow'); $('select#socios option[value=$idsocio]').attr('selected',true); $('#socios').prop('disabled', true);  ";
    		    else if ($_SESSION['cod_usuario'] == 7	)
    		    	echo " $('select#administradores option[value=018A62D9-638D-11E4-A503-0293ADBEA581]').attr('selected',true); $('#administradores').prop('disabled', true);  ";
?>
				 $( "#filtrar" ).click();
			    });


    </script>
    <script src="../js/jquery.multiple.select.js"></script>
                <script>
                $(function() {
                    $('#estado').change(function() {
                        console.log($(this).val());
                    }).multipleSelect({
                        width: '100%'
                    });
                });
               
                    function carregaGridClinicas()
                    {
                        var selValue = $('input[name=optionsRadiosInline]:checked').val();
						var mes = $('input[name=optionsRadiosInline2]:checked').val();
                        $("#teste").slideUp(300);
                        //$('.teste').slideDown();
                        var estado = $("select[name='estado'] option:selected").text();
                        var socios = $("select[name='socios'] option:selected").val();
                        var administradores = $("select[name='administradores'] option:selected").val();
                        $("#wait").show();
                        $("#divTabelaClinicas").hide();
                        $.ajax({
                        url: 'ajax_busca_'+selValue,
                        type: 'GET',
                        data: {uf: estado, idSocio: socios, mes: mes, adm: administradores},
                        success: function(results) {
                                $("#divTabelaClinicas").show();
                                $("#divTabelaClinicas").html(results);
                                $("#wait").hide();
                            }
                        });
                    }
                </script>
</body>
</body>

</html>
