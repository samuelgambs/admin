

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

    <!-- Timeline CSS
    <link href="../dist/css/timeline.css" rel="stylesheet">-->

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">-->

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

  
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" href="#"><img class="img-responsive" src="../logo.png" alt=""/></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> </a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
           
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">&nbsp;</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                           <!-- /.PAINEL ORÇAMENTOS -->
                <div class="col-lg-3 col-md-6">

                    <!-- /.PAINEL ORÇAMENTOS -->
                    <div class="panel panel-red">
                       <a data-toggle="modal" data-target="#modal_orcamentos" href="#modal_orcamentos" id="button_orcamentos">

                            <div class="panel-footer tooltip-demo" data-toggle="tooltip" data-placement="top" title="Clique Para Visualizar Meses Anteriores">
                              <i class="fa fa-pencil-square-o fa-2x"  data-toggle="tooltip" data-placement="right" title="Orçamentos"></i>


                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                 <span class="pull-right"><strong>ORÇAMENTOS -  MAR/2015 </strong></span>
                              <div class="clearfix"></div>
                            </div>
                        </a>
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 tooltip-demo">

                                      <div class="huge">
                                        <i class="fa fa-arrow-up" data-toggle="tooltip" data-placement="bottom" title="Parcial do Mês Atual em Comparação com a Relativa Data do Mês Anterior"></i>
                                        <b data-toggle="tooltip" data-placement="bottom" title="% de Orçamentos Sob o Total de Pacientes da Clínica">   21% </b>
                                      </div>
                                      <font size="+2" data-toggle="tooltip" data-placement="top" title="Total de Orçamentos no Mês  "><i>26 </i></font>
                               </div>
                                <div class="col-xs-9 text-right tooltip-demo">
                                    <div> <b data-toggle="tooltip" data-placement="left" title="% Média Regional de Orçamentos Sob o Total de Pacientes">
                                        <img  src="http://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Bandeira_do_Amazonas.svg/125px-Bandeira_do_Amazonas.svg.png" alt="Média Regional" width="15%" height="15%" vspace="10" title="Média Regional" rel="tooltip"> 
                                        <font size="+2">  12% </font></b> 
                                        <small data-toggle="tooltip" data-placement="right" title="Média Regional de Orçamentos ">(21)</small>
                                    </div>
                                <div> <b data-toggle="tooltip" data-placement="left" title="% Média Regional de Orçamentos Sob o Total de Pacientes">
                                        <img  src="http://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Bandeira_do_Amazonas.svg/125px-Bandeira_do_Amazonas.svg.png" alt="Média Regional" width="15%" height="15%" vspace="10" title="Média Regional" rel="tooltip"> 
                                        <font size="+2">  12% </font></b> 
                                        <small data-toggle="tooltip" data-placement="right" title="Média Regional de Orçamentos ">(21)</small>
                                    </div>
                                    <div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.FIM PAINEL ORÇAMENTOS -->

                <!-- /.PAINEL DOCUMENTAÇÕES-->

                         <!-- /.PAINEL pacientes--><!-- /.FIM PAINEL PACIENTES -->
              </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
          </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
     <!-- Modal -->
                            <div class="modal fade" id="modal_orcamentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Orçamentos</h4>
                                        </div>
                                              <div id="lin_orcamentos" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


                             <!-- Modal  documentações -->
                            <div class="modal fade" id="modal_documentacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Documentações</h4>
                                        </div>
                                              <div id="lin_documentacao" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                                       <!-- Modal  INICIOS -->
                            <div class="modal fade" id="modal_inicios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Inícios</h4>
                                        </div>
                                              <div id="lin_inicios" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                                 <!-- Modal  fluxo de pacientes -->
                            <div class="modal fade" id="modal_pacientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Fluxo de Pacientes</h4>
                                        </div>
                                              <div id="lin_fluxo_paciente" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


                                 <!-- Modal  faltosos -->
                            <div class="modal fade" id="modal_faltosos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Total de Faltosos</h4>
                                        </div>
                                              <div id="lin_faltosos" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->







                             <!-- Modal  lucro x paciente -->
                            <div class="modal fade" id="modal_lucro_paciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Lucro</h4>
                                        </div>
                                         <div id="lin_comparativo_receita_despesas" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


                                   <!-- Modal  CANCELAMENTOS -->
                            <div class="modal fade" id="modal_cancelamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Total de Cancelamentos</h4>
                                        </div>
                                              <div id="lin_cancelamento" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->




                             <!-- Modal  flutuantes -->
                            <div class="modal fade" id="modal_flutuantes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Flutuantes</h4>
                                        </div>
                                         <div id="lin_flutuantes" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                             <!-- Modal  inicios x orçcamento -->
                            <div class="modal fade" id="modal_inicios_orcamentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Inícios x Orçamentos</h4>
                                        </div>
                                         <div id="lin_tratamento_inicio_x_orcamento" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                  		  <!-- Modal GASTO DENTAL -->
                            <div class="modal fade" id="modal_gasto_dental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Gastos Dental</h4>
                                        </div>
                                         <div id="lin_gasto_dental" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            
                                  <!-- Modal CUSTO FUNCIONARIO -->
                            <div class="modal fade" id="modal_custo_funcionario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Custo Funcionário</h4>
                                        </div>
                                         <div id="lin_custo_funcionario" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                                     <!-- Modal  SUSPENSOESL -->
                            <div class="modal fade" id="modal_suspensoes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Suspensões</h4>
                                        </div>
                                         <div id="lin_suspensoes" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                                <!-- /.modal -->
                                     <!-- Modal  NEGOCIACAÇÃO -->
                            <div class="modal fade" id="modal_negociacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Histórico Negociação</h4>
                                        </div>
                                         <div id="lin_negociacao" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- Modal  FLUXO FM -->
                            <div class="modal fade" id="modal_fluxo_fm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Fluxo FM</h4>
                                        </div>
                                         <div id="lin_fluxo_fm" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->                            
  
                            <!-- Modal  NEGOCIACAÇÃO -->
                            <div class="modal fade" id="modal_entrada_orto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Entrada Orto</h4>
                                        </div>
                                         <div id="lin_entrada_orto" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
               <!-- Modal  cliente amigo -->
                            <div class="modal fade" id="modal_cliente_amigo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Cliente Amigo</h4>
                                        </div>
                                         <div id="lin_cliente_amigo" style="width: 900px; height: 500px"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->        


    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()

        


      $(document).ready(function() {
		      $("#modal_flutuantes").on('shown.bs.modal', function () {
		           startDrawingLinFlut()
		      });
		      $("#modal_fluxo_fm").on('shown.bs.modal', function () {
		           startDrawingLinFluxoFM()
		      });
		      $("#modal_entrada_orto").on('shown.bs.modal', function () {
		           startDrawingLinEntradaOrto()
		      });
		      $("#modal_orcamentos").on('shown.bs.modal', function () {
		           startDrawingLinOrc()
		      });
		       $("#modal_documentacao").on('shown.bs.modal', function () {
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
		        $("#modal_cancelamento").on('shown.bs.modal', function () {
		              startDrawingLinCancelamento()
		      });
		        $("#modal_inicios_orcamentos").on('shown.bs.modal', function () {
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
              $(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
                startDrawingValorNegociacao_ma()
                startDrawingValorNegociacao_mp()
           });

      });
    </script>

</body>

</html>
