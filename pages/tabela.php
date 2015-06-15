<?php
// Inclui o arquivo que faz a conexão ao banco de dados
require_once('../includes/mysqli.php');
// Monta a consulta SQL 
$sql = 	'  		SELECT a.NomeFantasia, 
		      		   b.ASSIDUOS_A1, b.ASSIDUOS_A2, b.data_inclusao,		  
			           C.FALTOSOS_B1, C.FALTOSOS_B2,
			           D.assiduos_c1, D.assiduos_c2,
			           e.faltosos_d1, e.faltosos_d2,
			           f.fm_mes_passado, f.fm_mes_atual,
			           g.qtd_flutuantes, g.porc_flutuantes,
			           h.orcamento_mes, h.orcamento_total,
			           i.documentacao_mes, i.documentacao_total,
			           j.inicio_mes, j.inicio_total,
			           k.orc_mespassado, k.ini_mespassado,	     k.orc_mesatual,     k.ini_mesatual,
			           l.agendados,  l.atendidos,      l.flutuantes as lflutuantes,
			           m.faltosos,  m.flutuantes as mflutuantes, m.total_faltosos,m.nao_ira_receber, m.porc_assiduos, m.porc_faltosos,
			           n.faltosos_agendados,     n.faltosos_nao_agendados,
			           o.0_a_1 as zero_um, o.1_a_2 as um_dois, o.2_a_3 as dois_tres,  o.3_a_4 as tres_quatro, o.acima_4,    o.total_geral,
			           p.media_gasto,  p.media_lucro        
		        FROM ap_clinicas a 
			    INNER JOIN (SELECT INSCRICAO, assiduos_a1, ASSIDUOS_A2, max(data_inclusao) as data_inclusao 
			    			  FROM cli_agendados_assiduos xx 
			              	 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_agendados_assiduos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) B ON b.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, FALTOSOS_B1, FALTOSOS_B2, MAX(data_inclusao) AS data_inclusao
			    			 FROM cli_agendados_faltosos xx
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_agendados_faltosos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) C ON C.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, assiduos_c1, assiduos_c2, MAX(data_inclusao) AS data_inclusao 
			    			 FROM cli_atendidos_assiduos xx
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_atendidos_assiduos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) D ON D.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, faltosos_d1, faltosos_d2, MAX(data_inclusao) AS data_inclusao 
			    			 FROM cli_atendidos_faltosos xx
		        			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_atendidos_faltosos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )	GROUP BY INSCRICAO ) E ON E.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, fm_mes_passado, fm_mes_ATUAL, MAX(data_inclusao) 
			    			FROM cli_fluxo_fm XX 
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_fluxo_fm x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) F ON F.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, qtd_flutuantes, porc_flutuantes, MAX(data_inclusao) AS data_inclusao 
			    	         FROM cli_flutuantes XX
			    	          WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_flutuantes x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) G ON G.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, orcamento_mes, orcamento_total, MAX(data_inclusao) AS data_inclusao 
			    			 FROM cli_orcamento XX
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_orcamento x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) H ON H.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, documentacao_mes, documentacao_total, MAX(data_inclusao) AS data_inclusao 
			    			FROM cli_documentacao   xx
			    			WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_documentacao x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) I ON I.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, inicio_mes, inicio_total, MAX(data_inclusao) AS data_inclusao 
			    			FROM cli_inicio xx
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_inicio x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )   GROUP BY INSCRICAO ) J ON J.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, orc_mespassado, ini_mespassado, orc_mesatual, ini_mesatual  
			    			FROM cli_orcamentos_x_inicios xx
			    			WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_orcamentos_x_inicios x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) K ON K.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, agendados, atendidos, flutuantes, MAX(data_inclusao) AS data_inclusao 
			    			FROM cli_tratamento_assiduos xx
			    			WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_tratamento_assiduos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) L ON L.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, faltosos, flutuantes, total_faltosos, nao_ira_receber, porc_assiduos, porc_faltosos, MAX(data_inclusao) AS data_inclusao 
			    			 FROM cli_tratamento_assiduos_x_faltosos xx
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_tratamento_assiduos_x_faltosos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) M ON M.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, faltosos_agendados, faltosos_nao_agendados, MAX(data_inclusao) AS data_inclusao 
			    		    	FROM cli_tratamento_faltosos  xx
			    		    	 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_tratamento_faltosos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) N ON N.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, 0_a_1, 1_a_2, 2_a_3, 3_a_4, acima_4, total_geral, MAX(data_inclusao) 
			    	  FROM cli_envelhecimento_clinica xx
			    	  WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_envelhecimento_clinica x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) O ON O.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, media_gasto, media_lucro, MAX(data_inclusao) 
			    	  FROM cli_custo_paciente xx
			    	  WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_custo_paciente x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) P ON P.INSCRICAO = substring(a.CNPJ,1,8)
			    WHERE a.tipoclinica = "F"
			    GROUP BY substring(a.CNPJ,1,8)';
		
// Executa a consulta OU mostra uma mensagem de erro
$resultado = $MySQLi->query($sql) OR trigger_error($MySQLi->error, E_USER_ERROR);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

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
<script type="text/javascript">
			/*	(function() {
					var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');
		
					request = true;
		
					b[c] = b[c].replace( rcs, ' ' );
					b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;
				}());


				$(document).on('change', 'table thead input', function() {
				    var checked = $(this).is(":checked");

				    var index = $(this).parent().index();
				        $('table tbody tr').each(function() {
				            if(checked) {
				                $(this).find("td").eq(index).show();   
				            } else {
				                $(this).find("td").eq(index).hide();   
				            }
				        });
				});*/
			
			</script>
            
            <script language="javascript">

// Set the default "show" mode to that specified by W3C DOM
// compliant browsers

var showMode = 'table-cell';

// However, IE5 at least does not render table cells correctly
// using the style 'table-cell', but does when the style 'block'
// is used, so handle this

if (document.all) showMode='block';

// This is the function that actually does the manipulation

function toggleVis(btn){

	// First isolate the checkbox by name using the
	// name of the form and the name of the checkbox

	btn   = document.forms['tcol'].elements[btn];

	// Next find all the table cells by using the DOM function
	// getElementsByName passing in the constructed name of
	// the cells, derived from the checkbox name

	cells = document.getElementsByName('t'+btn.name);

	// Once the cells and checkbox object has been retrieved
	// the show hide choice is simply whether the checkbox is
	// checked or clear

	mode = btn.checked ? showMode : 'none';

	// Apply the style to the CSS display property for the cells

	for(j = 0; j < cells.length; j++) cells[j].style.display = mode;
}

</script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include '../includes/menu.php'; ?>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                 <a class="logo" href="index.php?id=<?php echo $_GET['id']?>"><img class="img-responsive" src="../logo.png" alt=""/></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
             <!-- /.navbar-top-links --><!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tabelas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

      <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading"> DataTables Advanced Tables </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <form name="tcol" onSubmit="return false">
                Mostrar Colunas:
                <input type=checkbox name="col1" onClick="toggleVis(this.name)"  checked>
                Agendados -
                <input type=checkbox name="col2" onClick="toggleVis(this.name)"  checked>
                Atendidos -
                <input type=checkbox name="col3" onClick="toggleVis(this.name)"  checked>
                Fluxo FM -
                <input type=checkbox name="col4" onClick="toggleVis(this.name)"  checked>
                Flutuantes -
                <input type=checkbox name="col5" onClick="toggleVis(this.name)"  checked>
                Orçamentos -
                <input type=checkbox name="col6" onClick="toggleVis(this.name)"  checked>
                Documentações -
                <input type=checkbox name="col7" onClick="toggleVis(this.name)"  checked>
                Inícios -
                <input type=checkbox name="col8" onClick="toggleVis(this.name)"  checked>
                Orçamentos x Inícios -
                <input type=checkbox name="col9" onClick="toggleVis(this.name)"  checked>
                Tratamento Assíduos -
                <input type=checkbox name="col10" onClick="toggleVis(this.name)"  checked>
                Assíduos x Faltosos -
                <input type=checkbox name="col11" onClick="toggleVis(this.name)"  checked>
                Tratamento Faltosos -
                <input type=checkbox name="col12" onClick="toggleVis(this.name)" checked >
                Envelhecimento Clínica -
                <input type=checkbox name="col13" onClick="toggleVis(this.name)"  checked>
                Custo Paciente
              </form>
              <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th rowspan="3"  class="alert-success" style=" background-color:#DFF0D8; width:100%" data-class="expand">ClÍNICA</th>
                    </tr>
                    <tr>
                      <th colspan="4" style="text-align: center;" name="tcol1" id="tcol1" class="alert alert-info">AGENDADOS </th>
                      <th colspan="4" style="text-align: center;" name="tcol2" id="tcol2" class="alert alert-warning">ATENDIDOS</th>
                      <th colspan="2" style="text-align: center;" name="tcol3" id="tcol3" class="alert alert-info">FLUXO FM</th>
                      <th colspan="2" style="text-align: center;" name="tcol4" id="tcol4" class="alert alert-warning">FLUTUANT</th>
                      <th colspan="2" style="text-align: center;" name="tcol5" id="tcol5" class="alert alert-info">ORÇAMENT</th>
                      <th colspan="2" style="text-align: center;" name="tcol6" id="tcol6" class="alert alert-warning">DOCUMENT</th>
                      <th colspan="2" style="text-align: center;" name="tcol7" id="tcol7" class="alert alert-info">INÍCIOS</th>
                      <th colspan="4" style="text-align: center;" name="tcol8" id="tcol8" class="alert alert-warning">ORÇAMENTOS x INÍCIOS</th>
                      <th colspan="3" style="text-align: center;" name="tcol9" id="tcol9" class="alert alert-info">TRATAMENTO ASSÍDUOS</th>
                      <th colspan="6" style="text-align: center;" name="tcol10" id="tcol10" class="alert alert-warning">ASSÍDUOS x FALTOSOS</th>
                      <th colspan="2" style="text-align: center;" name="tcol11" id="tcol11" class="alert alert-info">TRATAMENTO FALTOSOS</th>
                      <th colspan="6" style="text-align: center;" name="tcol12" id="tcol12" class="alert alert-warning">ENVELHECIMENTO CLÍNICA</th>
                      <th colspan="2" style="text-align: center;" name="tcol13" id="tcol13" class="alert alert-info">CUSTO PACIENTE</th>
                    </tr>
                    <tr>
                      <th name="tcol1" id="tcol1" class="alert-info" style="background-color:#d9edf7">Assíd </th>
                      <th name="tcol1" id="tcol1" class="alert-info" style="background-color:#d9edf7">Tot</th>
                      <th name="tcol1" id="tcol1" class="alert-info" style="background-color:#d9edf7">Falt </th>
                      <th name="tcol1" id="tcol1" class="alert-info" style="background-color:#d9edf7">Tot</th>
                      <th class="alert-warning" id="tcol2" style="background-color:#fcf8e3" name="tcol2">Assíd </th>
                      <th name="tcol2" id="tcol2" class="alert-warning" style="background-color:#fcf8e3">Tot</th>
                      <th name="tcol2" id="tcol2" class="alert-warning" style="background-color:#fcf8e3">Falt </th>
                      <th id="tcol2" name="tcol2" class="alert-warning" style="background-color:#fcf8e3">Tot</th>
                      <th  name="tcol3" id="tcol3" style="background-color:#d9edf7">Mês Ant</th>
                      <th   name="tcol3" id="tcol3" style="background-color:#d9edf7">Mês Atual</th>
                      <th  name="tcol4" id="tcol4" style="background-color:#fcf8e3">Qtd</th>
                      <th  name="tcol4" id="tcol4" style="background-color:#fcf8e3">%Flut</th>
                      <th  name="tcol5" id="tcol5" style="background-color:#d9edf7">Mês</th>
                      <th  name="tcol5" id="tcol5" style="background-color:#d9edf7">Total</th>
                      <th  name="tcol6" id="tcol6" style="background-color:#fcf8e3">Mês </th>
                      <th  name="tcol6" id="tcol6" style="background-color:#fcf8e3">Total</th>
                      <th  name="tcol7" id="tcol7" style="background-color:#d9edf7">Mês</th>
                      <th  name="tcol7" id="tcol7" style="background-color:#d9edf7">Total</th>
                      <th  name="tcol8" id="tcol8" style="background-color:#fcf8e3">Orç Mês Ant</th>
                      <th  name="tcol8" id="tcol8" style="background-color:#fcf8e3">Ini Mês Ant</th>
                      <th  name="tcol8" id="tcol8" style="background-color:#fcf8e3">Orç Mês Atual</th>
                      <th  name="tcol8" id="tcol8" style="background-color:#fcf8e3">Ini Mês Atual</th>
                      <th  name="tcol9" id="tcol9" style="background-color:#d9edf7">Agend</th>
                      <th  name="tcol9" id="tcol9" style="background-color:#d9edf7">Atend</th>
                      <th  name="tcol9" id="tcol9" style="background-color:#d9edf7">Flutua</th>
                      <th  name="tcol10" id="tcol10" style="background-color:#fcf8e3">Falt</th>
                      <th  name="tcol10" id="tcol10" style="background-color:#fcf8e3">Flut</th>
                      <th  name="tcol10" id="tcol10" style="background-color:#fcf8e3">Tot Falt</th>
                      <th  name="tcol10" id="tcol10" style="background-color:#fcf8e3">Ñ irá receber</th>
                      <th  name="tcol10" id="tcol10" style="background-color:#fcf8e3">%Assid</th>
                      <th  name="tcol10" id="tcol10" style="background-color:#fcf8e3">%Falt</th>
                      <th  name="tcol11" id="tcol11" style="background-color:#d9edf7">Falt Agend</th>
                      <th  name="tcol11" id="tcol11" style="background-color:#d9edf7">Falt Ñ Agend</th>
                      <th  name="tcol12" id="tcol12" style="background-color:#fcf8e3">0-1</th>
                      <th  name="tcol12" id="tcol12" style="background-color:#fcf8e3">1-2</th>
                      <th  name="tcol12" id="tcol12" style="background-color:#fcf8e3">2-3</th>
                      <th  name="tcol12" id="tcol12" style="background-color:#fcf8e3">3-4</th>
                      <th  name="tcol12" id="tcol12" style="background-color:#fcf8e3">+4</th>
                      <th  name="tcol12" id="tcol12" style="background-color:#fcf8e3">Tot</th>
                      <th  name="tcol13" id="tcol13" style="background-color:#d9edf7">Mês Gasto</th>
                      <th  name="tcol13" id="tcol13" style="background-color:#d9edf7">Mês Lucro<br></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
			// Faz um loop, passando por todos os resultados encontrados
			while ($row = $resultado->fetch_object()) {                                               
				 ?>
                    <tr id="table_7_row_0">
                      <td class=""><a href="graficos.php?name=<?php echo $row->NomeFantasia;?>"><?php echo $row->NomeFantasia;?></a><br>
                        <small>(<?php echo date('d/m/Y', strtotime($row->data_inclusao));?>)</small></td>
                      <td class="" name="tcol1" id="tcol1"><?php echo $row->ASSIDUOS_A1;?></td>
                      <td class="" name="tcol1" id="tcol1"><?php echo $row->ASSIDUOS_A2;?></td>
                      <td class="numdata " name="tcol1" id="tcol1"><?php if ($row->FALTOSOS_B1 >100){?>
                        <font color="red"><?php echo $row->FALTOSOS_B1;?></font>
                        <?php } else {  echo $row->FALTOSOS_B1; }?></td>
                      <td class="numdata " name="tcol1" id="tcol1"><?php echo $row->FALTOSOS_B2;?></td>
                      <td class="numdata " name="tcol2" id="tcol2"><?php echo $row->assiduos_c1;?></td>
                      <td class="numdata " name="tcol2" id="tcol2"><?php echo $row->assiduos_c2;?></td>
                      <td class="numdata " name="tcol2" id="tcol2"><?php echo $row->faltosos_d1;?></td>
                      <td class="numdata " name="tcol2" id="tcol2"><?php if ($row->faltosos_d2 >100){?>
                        <font color="red"><?php echo $row->faltosos_d2;?></font>
                        <?php } else {  echo $row->faltosos_d2; }?></td>
                      <td class="numdata " name="tcol3" id="tcol3"><?php echo $row->fm_mes_passado;?></td>
                      <td class="numdata " name="tcol3" id="tcol3"><?php echo $row->fm_mes_atual;?></td>
                      <td class="numdata " name="tcol4" id="tcol4"><?php if ($row->qtd_flutuantes > 50){?>
                        <font color="red"><?php echo $row->qtd_flutuantes;?></font>
                        <?php } else {  echo $row->qtd_flutuantes; }?></td>
                      <td class="numdata " name="tcol4" id="tcol4"><?php echo $row->porc_flutuantes;?>%</td>
                      <td class="numdata " name="tcol5" id="tcol5"><?php echo $row->orcamento_mes;?></td>
                      <td class="numdata " name="tcol5" id="tcol5"><?php echo $row->orcamento_total;?></td>
                      <td class="numdata " name="tcol6" id="tcol6"><?php echo $row->documentacao_mes;?></td>
                      <td class="numdata " name="tcol6" id="tcol6"><?php echo $row->documentacao_total;?></td>
                      <td class="numdata " name="tcol7" id="tcol7"><?php echo $row->inicio_mes;?></td>
                      <td class="numdata " name="tcol7" id="tcol7"><?php echo $row->inicio_total;?></td>
                      <td class="numdata " name="tcol8" id="tcol8"><?php echo $row->orc_mespassado;?></td>
                      <td class="numdata " name="tcol8" id="tcol8"><?php echo $row->ini_mespassado;?></td>
                      <td class="numdata " name="tcol8" id="tcol8"><?php echo $row->orc_mesatual;?></td>
                      <td class="numdata " name="tcol8" id="tcol8"><?php echo $row->ini_mesatual;?></td>
                      <td class="numdata " name="tcol9" id="tcol9"><?php echo $row->agendados;?></td>
                      <td class="numdata " name="tcol9" id="tcol9"><?php echo $row->atendidos;?></td>
                      <td class="numdata " name="tcol9" id="tcol9"><?php echo $row->lflutuantes;?></td>
                      <td class="numdata " name="tcol10" id="tcol10"><?php echo $row->faltosos;?></td>
                      <td class="numdata " name="tcol10" id="tcol10"><?php echo $row->mflutuantes;?></td>
                      <td class="numdata " name="tcol10" id="tcol10"><?php echo $row->total_faltosos;?></td>
                      <td class="numdata " name="tcol10" id="tcol10"><font color="red"><b>R$<?php echo $row->nao_ira_receber;?></b></font></td>
                      <td class="numdata " name="tcol10" id="tcol10"><?php echo $row->porc_assiduos;?>%</td>
                      <td class="numdata " name="tcol10" id="tcol10"><?php echo $row->porc_faltosos;?>%</td>
                      <td class="numdata " name="tcol11" id="tcol11"><?php echo $row->faltosos_agendados;?></td>
                      <td class="numdata " name="tcol11" id="tcol11"><?php echo $row->faltosos_nao_agendados;?></td>
                      <td class="numdata " name="tcol12" id="tcol12"><?php echo $row->zero_um;?></td>
                      <td class="numdata " name="tcol12" id="tcol12"><?php echo $row->um_dois;?></td>
                      <td class="numdata " name="tcol12" id="tcol12"><?php echo $row->dois_tres;?></td>
                      <td class="numdata " name="tcol12" id="tcol12"><?php echo $row->tres_quatro;?></td>
                      <td class="numdata " name="tcol12" id="tcol12"><?php echo $row->acima_4;?></td>
                      <td class="numdata " name="tcol12" id="tcol12"><?php echo $row->total_geral;?></td>
                      <td class="numdata "  name="tcol13" id="tcol13"><?php echo $row->media_gasto;?></td>
                      <td class="numdata "  name="tcol13" id="tcol13"><?php echo $row->media_lucro;?></td>
                      <?php } ?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: false
        });
    });
    </script>

</body>

</html>
