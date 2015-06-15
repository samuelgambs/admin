7<?php 


require_once('../includes/queries.php');
//require_once('../includes/graphs.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rede Odonto Gráficos</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS  -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS 
    <link href="../css/timeline.css" rel="stylesheet">-->

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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
 //função para deixar grafico responsivo
    window.onresize = function(){
        startDrawingAgAss();
        startDrawingAgFal();
        startDrawingAtAss();
        startDrawingAtFal();
        startDrawingFlut();
        startDrawingFluFM();
        startDrawingTratFal();
        startDrawingTratAss();
        startDrawingOrc();
        startDrawingDoc();
        startDrawingIni();
        startDrawingEnvCli();
        startDrawingCusPac();
        startDrawingNeg();
        startDrawingAssXFal();
        startDrawingOrcXIni();


    };
    window.onload = function(){
        startDrawingAgAss();
        startDrawingAgFal();
        startDrawingAtAss();
        startDrawingAtFal();
        startDrawingFlut();
        startDrawingFluFM();
        startDrawingTratFal();
        startDrawingTratAss();
        startDrawingOrc();
        startDrawingDoc();
        startDrawingIni();
        startDrawingEnvCli();
        startDrawingCusPac();
        startDrawingNeg();
        startDrawingAssXFal();
        startDrawingOrcXIni();
    };

     //variaveis com os valores para gerar os graficos 
     var data_AgAss = [
                        ['Assíduos', 'Agendados'],
                        ['Assíduos Mês', <?php echo $assiduos_a1; ?>],
                        ['Total Restante de Assíduos',<?php echo $assiduos_a2-$assiduos_a1; ?>]
                    ];

     var data_AgFal = [
                      ['Faltosos', 'Agendados'],
                      ['Faltosos Mês', <?php echo $faltosos_b1; ?>],
                      ['Total Restante de Faltosos',<?php echo $faltosos_b2-$faltosos_b1; ?>],
                  ];  

     var data_AtAss = [
                        ['Assíduos', 'Atendidos'],
                        ['Atendidos Mês', <?php echo $assiduos_c1; ?>],
                        ['Ainda não atendidos',<?php echo $assiduos_c2-$assiduos_c1; ?>]
                    ];   

     var data_AtFal = [
                         ['Faltosos', 'Atendidos'],
                          ['Faltosos Atendidos', <?php echo $faltosos_d1; ?>],
                          ['Não atendidos',<?php echo $faltosos_d2-$faltosos_d1; ?>],
     ];   

     var data_Flut = [
                         ['Flutuantes', 'Total'],
                          ['Flutuantes', <?php echo $qtd_flutuantes; ?>],
                          ['Total Assíduos',<?php echo $assiduos_a2 ?>],
     ];     

     var data_FluFM = [
                         ['Faltosos', 'Quantidade', { role: 'style' }],
                         ['Mês Passado', <?php echo $fm_mes_passado ?>, '#017cc2'],            
                         ['Mês Atual', <?php echo $fm_mes_atual ?>, '#86c127'],      
     ];     

    var data_TratFal = [      
                            ['Faltosos', 'Quantidade', { role: 'style' }],
                             ['Não Agendados', <?php echo $faltosos_agendados ?>, '#017cc2'],            // RGB value
                             ['Agendados', <?php echo $faltosos_nao_agendados ?>, '#86c127'],
                        ];  

    var data_TratAss = [   
                         ['Assíduos', 'Quantidade', { role: 'style' }],
                         ['Agendados', <?php echo $taagendados ?>, '#017cc2'],            // RGB value
                         ['Atendidos', <?php echo $taatendidos ?>, '#86c127'],  
                         ['Flutuantes', <?php echo $taflutuantes ?>, '#da251c'],       

    ];

    var data_Orc = [   
                         ['Orçamentos', 'Total'],
                          ['Orçamentos Mês', <?php echo $orcamento_mes; ?>],
                          ['Orçamentos Total',<?php echo $orcamento_total ?>],
        ];

    var data_Doc = [       
                         ['Documentação', 'Total'],
                          ['Documentação Mês', <?php echo $documentacao_mes; ?>],
                          ['Documentação Total',<?php echo $documentacao_total ?>],
                     ];

    var data_Ini = [       
                     ['Inícios', 'Total'],
                      ['Inícios Mês', <?php echo $inicio_mes; ?>],
                      ['Inícios Total',<?php echo $inicio_total ?>],    
                ];          

    var data_EnvCli =   [
                     ['Envelhecimento', 'Quantidade'],
                      ['Zero a Um Ano', <?php echo $zero_a_um; ?>],
                      ['Um a Dois Anos',<?php echo $um_a_dois ?>],
                      ['Dois a Três Anos',<?php echo $dois_a_tres ?>],
                      ['Três a Quatro Anos',<?php echo $tres_a_quatro ?>],
                      ['Acima de Quatro Anos',<?php echo $acima_4 ?>],
    ];      

    var data_CusPac =   [    
                            ['Custo', 'Media', { role: 'style' }],
                              <?php if ( $media_lucro > $media_gasto ) {?>
                                ['Média Lucro', <?php echo $media_lucro; ?>,  '#da251c'],
                                ['Média Gasto', <?php echo $media_lucro-$media_gasto;?>, '#86c127'],
                             <?php  } 
                              else { ?>
                                ['Média Gasto', <?php echo $media_gasto; ?>,  '#86c127'],
                                ['Média Lucro', <?php echo $media_gasto-$media_lucro; ?>,  '#da251c'],
                             <?php  } ?>
                             ];

    var data_Neg =   [    
                              ['negociacao', 'Total'],
                              ['Total a Receber', <?php echo $total_a_receber; ?>],
                              ['Total em Atraso',<?php echo $total_em_atraso ?>],
                            ];

    var data_AssXFal =   [             
                               ['Tratamento', 'Total'],
                                  ['Assíduos', <?php echo $assiduos_a2+$assiduos_c2; ?>],
                                  ['Faltosos',<?php echo $aftotal_faltosos ?>],       
                            ];    

    var data_OrcXIni_old = [
                    ['Mês Passado', 'Valores'],           
                    ['Orçamentos', <?php echo $orc_mespassado;?>], 
                    ['Inícios', <?php echo $ini_mespassado;?>]
                ];

    var data_OrcXIni_new =  [
                      ['Mês Atual', 'Valores'],        
                      ['Orçamentos', <?php echo $orc_mesatual;?>], 
                      ['Inícios', <?php echo $ini_mesatual;?>]
                ];


     //desenhando grafico
     startDrawingAgAss = function(){
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
 
        function drawChart() {
            var data = google.visualization.arrayToDataTable(data_AgAss);
 
            var options = {
              title: 'Agendados Assíduos',
              is3D: true,
              hAxis: {title: 'Year',  titleTextStyle: {color: 'red'}}
            };
 
            var chart = new google.visualization.PieChart(document.getElementById('agendados_assiduos'));
            chart.draw(data, options);
        }
    };     

    startDrawingAgFal = function(){      
     google.load("visualization", "1", {packages:["corechart"],callback: drawChart});   
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_AgFal);
         
        var options = {
          title: 'Agendados Faltosos',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('agendados_faltosos'));
        chart.draw(data, options);
      }
    };

    startDrawingAtAss = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_AtAss);
        
        var options = {
          title: 'Atendidos Assíduos',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('atendidos_assiduos'));
        chart.draw(data, options);
      }
  };
  
   startDrawingAtFal = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_AtFal);

         var options = {
          title: 'Atendidos Faltosos',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('atendidos_faltosos'));
        chart.draw(data, options);
      }
  };

   startDrawingFlut = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_Flut);
         var options = {
          title: 'Flutuantes',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('flutuantes'));
        chart.draw(data, options);
      }
  };

    startDrawingFluFM = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_FluFM);
      var options = {
        
          is3D: true,
        };

        var chart = new google.visualization.BarChart(document.getElementById('fluxo_fm'));
        chart.draw(data, options);
      }
    };

    startDrawingTratFal = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_TratFal);  
        var options = {
          title: 'Tratamento Faltosos',
          is3D: true,
        };

        var chart = new google.visualization.BarChart(document.getElementById('tratamento_faltosos'));
        chart.draw(data, options);
      }
  };

    
    startDrawingTratAss = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_TratAss);  
          var options = {
          title: 'Tratamento Assíduos',
          is3D: true,
        };

        var chart = new google.visualization.BarChart(document.getElementById('tratamento_assiduos'));
        chart.draw(data, options);
      }
};
    
     startDrawingOrc = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_Orc);  
        var options = {
          title: 'Orçamentos',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('orcamentos'));
        chart.draw(data, options);
      }
  };

    startDrawingDoc = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_Doc);  
        var options = {
          title: 'Documentação',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('documentacao'));
        chart.draw(data, options);
      }
  };

    startDrawingIni = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_Ini);  

          var options = {
          title: 'Inícios',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('inicio'));
        chart.draw(data, options);
      }
  };

  startDrawingEnvCli = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_EnvCli);  
        var options = {
          title: 'Envelhecimento Clínica',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('envelhecimento'));
        chart.draw(data, options);
      }
  };

  startDrawingCusPac = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_CusPac);  

         var options = {
          title: 'Custo Paciente',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('custo_paciente'));
        chart.draw(data, options);
      }
  };


  startDrawingNeg = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_Neg);  

        var options = {
          title: 'Negociação',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('negociacao'));
        chart.draw(data, options);
      }
    };

    startDrawingAssXFal = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_AssXFal);  
         var options = {
          title: 'Tratamento Assíduos x Faltosos',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('assiduos_x_faltosos'));
        chart.draw(data, options);
      }
  };

  startDrawingOrcXIni = function(){    
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});  
      function drawChart() {
        
         var oldData = google.visualization.arrayToDataTable(data_OrcXIni_old); 
         var newData = google.visualization.arrayToDataTable(data_OrcXIni_new); 
        
         var options = { pieSliceText: 'none', 
        		 innerCircle: { radiusFactor: 0.3 }
       };

         var chartBefore = new google.visualization.PieChart(document.getElementById('piechart_before'));
         var chartAfter = new google.visualization.PieChart(document.getElementById('piechart_after'));
         var chartDiff = new google.visualization.PieChart(document.getElementById('piechart_diff'));  
         chartBefore.draw(oldData, options);
         chartAfter.draw(newData, options);

         var diffData = chartDiff.computeDiff(oldData, newData);
         chartDiff.draw(diffData, options);
        }
      };


     </script>   

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
            <!-- /.navbar-top-links -->
             <?php include '../includes/menu.php'; ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gráficos - <?php echo $nomefantasia;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
               
                <!-- /.col-lg-12 -->
                <div class="col-lg-6">
                  <div class="panel panel-default">
                    <div class="panel-heading"> Agendados Assíduos </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                      <!-- Nav tabs -->
                     
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane fade in active" id="agendados-assiduos">
                          <div id="agendados_assiduos" style="width:100%;height:400px;"></div>
                        </div>
                        <div class="tab-pane fade in" id="lin-agendados-assiduos">
                          <div id="lin_agendados_assiduos" style="height:749px;height:400px;"></div>
                        </div>
                      </div>
                    </div>
                    <!-- /.panel-body -->
                  </div>
                  <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
              
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Agendados Faltosos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="agendados_faltosos" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                 <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Atendidos Assíduos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="atendidos_assiduos" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                  <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Atendidos Faltosos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="atendidos_faltosos" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>


                <!-- /.col-lg-6 -->
                 <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Flutuantes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="flutuantes" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Fluxo FM
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="fluxo_fm" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tratamento Faltosos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                              <div id="tratamento_faltosos" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tratamento Assíduos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                              <div id="tratamento_assiduos" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
              <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Orçamentos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="orcamentos" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <!-- /.col-lg-6 -->
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Documentação
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="documentacao" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                    <!-- /.col-lg-6 -->
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Inícios
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="inicio" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                     <!-- /.col-lg-6 -->
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Envelhecimento Da Clínica
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="envelhecimento" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                 </div>    
                    <!-- /.panel -->
                      <!-- /.col-lg-6 -->
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Custo Paciente
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="custo_paciente" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>   
                    <!-- /.panel -->   
                          <!-- /.col-lg-6  -->
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Negociação
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="negociacao" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                 </div>    
                    <!-- /.panel -->   
                         <!-- /.col-lg-6 -->
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tratamento Assíduos x Faltosos

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="assiduos_x_faltosos" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Orçamento x Inícios

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="piechart_before" style="display:none"></div>
                                <div id="piechart_after" style="display:none"></div>
                                <div id="piechart_diff" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
               
              <!-- /.col-lg-6 -->
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
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

    <!-- Flot Charts JavaScript 
    <script src="../bower_components/flot/excanvas.min.js"></script>
    <script src="../bower_components/flot/jquery.flot.js"></script>
    <script src="../bower_components/flot/jquery.flot.pie.js"></script>
    <script src="../bower_components/flot/jquery.flot.resize.js"></script>
    <script src="../bower_components/flot/jquery.flot.time.js"></script>
    <script src="../bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../js/flot-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
