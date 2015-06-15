<?php

require_once('../includes/queries.php');
include "functions.php";
session_start();
session_checker();
error_reporting(E_ALL);
require_once('../includes/queries_linha.php');

$usuario_id =$_SESSION['usuario_id'];

$sqlbuscaclinicas =  "SELECT t1.nomefantasia,t1.idclinica
FROM (SELECT a.nomefantasia,a.idclinica
FROM ap_clinicas a
WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'
GROUP BY substring(a.CNPJ,1,8)
ORDER BY nomefantasia ) T1
INNER JOIN ap_clinica_socios T ON T.idClinica = T1.IdClinica
WHERE T.idSocio = '$usuario_id' " ;
$query_busca_clinicas = $MySQLi->query($sqlbuscaclinicas) or trigger_error($MySQLi->error, E_USER_ERROR);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style type="text/css">
* {
  @include box-sizing(border-box);
}

$pad: 20px;

.grid {
  background: white;
  margin: 0 0 $pad 0;

  &:after {
    /* Or @extend clearfix */
    content: "";
    display: table;
    clear: both;
  }
}

[class*='col-'] {
  float: left;
  padding-right: $pad;
  .grid &:last-of-type {
    padding-right: 0;
  }
}
.col-2-3 {
  width: 66.66%;
}
.col-1-3 {
  width: 33.33%;
}
.col-1-2 {
  width: 50%;
}
.col-1-4 {
  width: 25%;
}
.col-1-8 {
  width: 12.5%;
}

/* Opt-in outside padding */
.grid-pad {
  padding: $pad 0 $pad $pad;
  [class*='col-']:last-of-type {
    padding-right: $pad;
  }
}
.chart {
  width: 100%;
  height: 600px;
}
.panel-heading a:  {
    font-family:'Glyphicons Halflings';
    content:"\e114";
    float: right;
    color: grey;
}
.panel-heading a.collapsed:after {
    content:"\e080";
}

th, td {
  text-align: center;
  border-right: 1px solid #fff;
  border-left: 1px solid #fff;
  font-weight: bold;
  
}
 td {
  font-size:48px;
 }
 th{
  text-align:center;
 }

</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rede Odonto - Relatórios Gerenciais</title>

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

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>


     <?php include '../includes/graficos_js.php';?>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include '../includes/navigation.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-header"> <?php echo ucfirst(strtolower($nomefantasia)); ?><small>   <?php echo ' • '.$estado.' • '.$mespassado; ?>  </small> <input id="inscricaoclinica" type="hidden" value="<?php echo $id; ?>"></h1>
                                         <div class="form-group">
                                            <select class="form-control" style="width:200px" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
  
                                            <option>Clínicas...</option>
                                        <?php while ($row_busca_clinicas = $query_busca_clinicas->fetch_object()) { ?>
                                                <option value="index.php?idclinica=<?php echo $row_busca_clinicas->idclinica;?>"><?php echo ucfirst(strtolower($row_busca_clinicas->nomefantasia))?></option>
                                        <?php  } ?> 
                                            </select>
                                        </div>
                    <i>Atualizado em: <?php  echo date('d/m/Y H:m:i', strtotime($data_atualizacao))  ;?></i>

                </div>

                   <div class="col-md-4 tooltip-demo" style="text-align: right; margin-top: 125px;">
                  <button type="button" class="btn btn-default btn-circle btn-lg" data-container="body" data-toggle="popover" data-placement="left" data-content="Vermelho: Abaixo das médias regionais e nacionais. Laranja: Acima de uma média e abaixo de outra. Verde: Acima das médias " data-original-title="" title="" aria-describedby="popover329217">
                  <i class="fa fa-question"></i>
                            </button>
                </div>

                <!-- /.col-lg-12 -->
            </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="pull-right" style="padding-bottom: 10px; padding-top: 10px;"> <a id="expandAll" href="#" class="btn btn-default" role="button">Expandir Todos</a>

                <a id="collapseAll" href="#" class="btn btn-default" role="button">Agrupar Todos</a>
            </div>
        </div>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="">
                                <i class="fa fa-group"></i> Número Total de Pacientes
                               <!--  <div>
                                   <i class="fa fa-circle" style="color:green;text-align:right"></i>
                                </div> -->
                              </a>
                            </h4>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                                <div class="panel panel-success">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse333" class="">
                                              <i class="fa fa-group"></i> Pacientes
                                  </a>
                                </h4>
                                </div>
                                <div id="collapse333" class="panel-collapse collapse">
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="">
                              <i class="fa fa-pencil-square-o"></i>   Orçamentos
                              </a>
                            </h4>

                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                           <div class="panel panel-success">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse444" class="">
                                              <i class="fa fa-group"></i> Numérico
                                              <i class="fa fa-frown-o "></i><i class="fa fa-meh-o "></i>
                                  </a>
                                </h4>
                                </div>
                                <div id="collapse444" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <table width="100%" >
                                       <tr >
                                         <th style="text-align:center" >Junho</th>
                                         <th style="text-align:center">Maio</th>
                                       </tr>
                                       <tr align="center">
                                         <td>65</td>
                                         <td>58</td>
                                       </tr>
                                      </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="">
                                              <i class="fa fa-group"></i> Porcentagem
                                  </a>
                                </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                       <table width="100%" align="center">
                                       <tr align="center">
                                         <th style="text-align:center">Junho</th>
                                         <th style="text-align:center">Maio</th>
                                       </tr>
                                       <tr align="center">
                                         <td style="font-size: -webkit-xxx-large;">10%</td>
                                         <td style="font-size: -webkit-xxx-large;">16%</td>
                                       </tr>
                                      </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="">
                                <i class="fa fa-file-o"></i> Documentações
                              </a>
                            </h4>

                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                            moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                            synth nesciunt you probably haven't heard of them accusamus labore sustainable
                            VHS.</div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="">
                               <i class="fa fa-flag-o"></i>  Inícios
                              </a>
                            </h4>

                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                            moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                            synth nesciunt you probably haven't heard of them accusamus labore sustainable
                            VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="">
                               Pacientes em Tratamento
                              </a>
                            </h4>

                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                            moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                            synth nesciunt you probably haven't heard of them accusamus labore sustainable
                            VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="">
                                <i class="fa fa-dollar"></i>    Financeiro
                              </a>
                            </h4>

                    </div>
                    <div id="collapseSix" class="panel-collapse collapse">
                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                            moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                            synth nesciunt you probably haven't heard of them accusamus labore sustainable
                            VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" class="">
                                Despesas
                              </a>
                            </h4>

                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse">
                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                            moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                            synth nesciunt you probably haven't heard of them accusamus labore sustainable
                            VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight" class="">
                                Custo por Paciente
                              </a>
                            </h4>

                    </div>
                    <div id="collapseEight" class="panel-collapse collapse">
                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                            moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                            synth nesciunt you probably haven't heard of them accusamus labore sustainable
                            VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine" class="">
                                Lucro por Paciente
                              </a>
                            </h4>

                    </div>
                    <div id="collapseNine" class="panel-collapse collapse">
                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                            moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                            synth nesciunt you probably haven't heard of them accusamus labore sustainable
                            VHS.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


          



              </div>
               <div class="row"></div> 
                 <div class="row">
                    <!-- /.PAINEL PACIENTES--><!-- /.PAINEL PACIENTES-->
  
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
     <!-- Modal -->
                          <?php include '../includes/modals.php';?>



    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    <?php include  '../includes/chama_ajax.php'; ?>
    <script>
  
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })


    // popover demo
    $("[data-toggle=popover]")
        .popover()

        $(function () {     
                    $('a[data-toggle="collapse"]').on('click',function(){
        
        var objectID=$(this).attr('href');
        
        if($(objectID).hasClass('in'))
        {
                                    $(objectID).collapse('hide');
        }
        
        else{
                                    $(objectID).collapse('show');
        }
                    });
                    
                    
                    $('#expandAll').on('click',function(){
                        
                        $('a[data-toggle="collapse"]').each(function(){
                            var objectID=$(this).attr('href');
                            if($(objectID).hasClass('in')===false)
                            {
                                 $(objectID).collapse('show');
                            }
                        });
                    });
                    
                    $('#collapseAll').on('click',function(){
                        
                        $('a[data-toggle="collapse"]').each(function(){
                            var objectID=$(this).attr('href');
                            $(objectID).collapse('hide');
                        });
                    });
                    
    });

   


      $(document).ready(function() {

    		$( "#link_mp_orc" ).click();
        	$( "#link_mp_doc" ).click();
        	$( "#link_mp_ini" ).click();
        	$( "#link_mp_ini_orc" ).click();
        	$( "#link_mp_fal_tot" ).click();
            $( "#link_mp_fal_ate" ).click();
            $( "#link_mp_fal_age" ).click();
            $( "#link_mp_flut" ).click();
            $( "#link_mp_ind_fal" ).click();
            $( "#link_mp_canc" ).click();
            $( "#link_mp_susp" ).click();
            $( "#link_mp_gast_dent" ).click();
            $( "#link_mp_cust_funci" ).click();
            $( "#link_mp_luc_pac" ).click();
            $( "#link_mp_entr_orto" ).click();
            $( "#link_mp_fm" ).click();
            $( "#link_mp_fm_pag" ).click();
            $( "#link_mp_fm_n_pag" ).click();
            $( "#link_mp_negociacao" ).click();
            $( "#link_mp_pacientes" ).click();
            $( "#link_mp_cli_amigo" ).click();
            $( "#link_mp_cli_amigo_conte" ).click(); 
            $( "#link_mp_cli_amigo_permitido" ).click();   
            $( "#link_mp_aproveitamento" ).click();            
                       
            $( "#link_mp_aband" ).click();



		      $("#modal_flutuantes").on('shown.bs.modal', function () {
		           startDrawingLinFlut()
		      });
		      $("#modal_fm").on('shown.bs.modal', function () {
		           startDrawingLinFluxoFM()
		      });
		      $("#modal_entrada_orto").on('shown.bs.modal', function () {
		           startDrawingLinEntradaOrto()
		      });
		      $("#modal_orcamentos").on('shown.bs.modal', function () {
		           startDrawingLinOrc()
		      });
		       $("#modal_documentacoes").on('shown.bs.modal', function () {
		           startDrawingLinDoc()
		      });
		        $("#modal_inicios").on('shown.bs.modal', function () {
		           startDrawingLinIni()
		      });
		        $("#modal_pacientes").on('shown.bs.modal', function () {
		              startDrawingLinFluPac()
		      });
          	  $("#modal_cliente_amigo").on('shown.bs.modal', function () {
                  startDrawingLinClienteAmigo()
         	  });
		        $("#modal_faltosos").on('shown.bs.modal', function () {
		              startDrawingLinFaltosos()
		      });
		        $("#modal_lucro_paciente").on('shown.bs.modal', function () {
		              startDrawingLinCompRecDesp()
		      });
		        $("#modal_cancelamentos").on('shown.bs.modal', function () {
		              startDrawingLinCancelamento()
		      });
		        $("#modal_aproveitamento").on('shown.bs.modal', function () {
		              startDrawingLinIniXOrc()
		      });
		        $("#modal_gasto_dental").on('shown.bs.modal', function () {
		              startDrawingLinGastosDental()
		      });
		    	$("#modal_custo_funcionario").on('shown.bs.modal', function () {
		            startDrawingLinCustoFuncionario()
		 	   });
       	  	   $("#modal_suspensoes").on('shown.bs.modal', function () {
                startDrawingLinSuspensoes()
     		   });
          	  $("#modal_negociacao").on('shown.bs.modal', function () {
                startDrawingLinNegociacao()
       		  });
          	  $("#modal_abandono").on('shown.bs.modal', function () {
                  startDrawingLinAbandono()
         		 });
          	  $("#modal_faltosos_agendados").on('shown.bs.modal', function () {
                  startDrawingFaltososAgendados()
         		 });
          	  $("#modal_faltosos_atendidos").on('shown.bs.modal', function () {
                  startDrawingFaltososAtendidos()
         		 });
          	$("#modal_indice_de_faltas").on('shown.bs.modal', function () {
          		startDrawingLinIndiceFalta()
       		 });

           $('#modal_cadastro').on('shown.bs.modal',function(){      //correct here use 'shown.bs.modal' event which comes in bootstrap3
            $(this).find('iframe').attr('src','formulario_cadastro.php?tipouser=<?php echo ($_SESSION['cod_usuario'])?>')
          }) 
      		       		 $(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
                startDrawingValorNegociacao_ma()
                startDrawingValorNegociacao_mp()
           });

      });
    </script>

</body>

</html>
