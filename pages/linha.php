<?php 
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

    <title>Rede Odonto - Relatórios Gerenciais</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
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
    <![endif]
<script type="text/javascript">
function chamaLinha() {
   
    $('#agendados_assiduos').attr('id','lin_agendados_assiduos');
    $("#lin_agendados_assiduos").load(location.href + " #lin_agendados_assiduos");
    
}

</script>-->
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
    window.onresize = function(){
        startDrawingLinAgAss();
        startDrawingLinAgFal();
        startDrawingLinAtAss();
        startDrawingLinAtFal();
        startDrawingLinFluFM();
        startDrawingLinFlut();
        startDrawingLinOrc();
        startDrawingLinDoc();
        startDrawingLinIni();
        startDrawingLinCusPac();
        startDrawingLinNeg();
        startDrawingLinAssXFal();
        startDrawingLinFluPac();
        startDrawingLinIniXOrc();
        startDrawingLinCompRecDesp();
      
    };
    window.onload = function(){
        startDrawingLinAgAss();
        startDrawingLinAgFal();
        startDrawingLinAtAss();
        startDrawingLinAtFal();
        startDrawingLinFluFM();
        startDrawingLinFlut();
        startDrawingLinOrc();
        startDrawingLinDoc();
        startDrawingLinIni();
        startDrawingLinCusPac();
        startDrawingLinNeg();
        startDrawingLinAssXFal();
        startDrawingLinFluPac();
        startDrawingLinIniXOrc();
        startDrawingLinCompRecDesp();
       
    };    

    //variaveis com os valores para gerar os graficos 

    var data_LinAgAss = [
                          ['Data Referência', 'Total'],
                           <?php while ($row_lin_agendados_assiduo = $query_lin_agendados_assiduos->fetch_object()) {
                          ?>
                          ['<?php echo $row_lin_agendados_assiduo->dataref; ?>', <?php echo $row_lin_agendados_assiduo->total; ?> ],            
                           <?php }     ?>
                        ];

    var data_LinAgFal = [
                           ['Data Referência', 'Total'],
                           <?php while ($row_lin_agendados_faltosos = $query_lin_agendados_faltosos->fetch_object()) {
                                ?>
                           ['<?php echo $row_lin_agendados_faltosos->dataref; ?>', <?php echo $row_lin_agendados_faltosos->total; ?> ],            
                             <?php }     ?>
                        ];

    var data_LinAtAss = [
                             ['Data Referência', 'Total'],
                              <?php while ($row_lin_atendidos_assiduos = $query_lin_atendidos_assiduos->fetch_object()) {
                                ?>
                                ['<?php echo $row_lin_atendidos_assiduos->dataref; ?>', <?php echo $row_lin_atendidos_assiduos->total; ?> ],            
                             <?php }     ?>
                             ]; 

    var data_LinAtFal = [
                              ['Data Referência', 'Total'],
                              <?php while ($row_lin_atendidos_faltosos = $query_lin_atendidos_faltosos->fetch_object()) {
                                ?>
                                ['<?php echo $row_lin_atendidos_faltosos->dataref; ?>', <?php echo $row_lin_atendidos_faltosos->total; ?> ],            
                             <?php }     ?>
                        ];    

    var data_LinFluFM = [
                                  ['Data Referência', 'Total'],
                                  <?php while ($row_lin_fluxo_fm = $query_lin_fluxo_fm->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_fluxo_fm->dataref; ?>', <?php echo $row_lin_fluxo_fm->total; ?> ],            
                                 <?php }     ?>
                            ];     

    var data_LinFlut = [
                                  ['Data Referência', 'Total'],
                                  <?php while ($row_lin_flutuantes = $query_lin_flutuantes->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_flutuantes->dataref; ?>', <?php echo $row_lin_flutuantes->total; ?> ],            
                                 <?php }     ?>
                            ];     

    var data_LinOrc = [
                                  ['Data Referência', 'Total'],
                                   <?php while ($row_lin_orcamento = $query_lin_orcamento->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_orcamento->dataref; ?>', <?php echo $row_lin_orcamento->total; ?> ],            
                                 <?php }     ?>
                            ];      

    var data_LinDoc = [
                                  ['Data Referência', 'Total'],     
                                   <?php while ($row_lin_documentacao = $query_lin_documentacao->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_documentacao->dataref; ?>', <?php echo $row_lin_documentacao->total; ?> ],            
                                 <?php }     ?>      
                                 ];

    var data_LinIni = [
                                  ['Data Referência', 'Total'],     
                                   <?php while ($row_lin_inicio = $query_lin_inicio->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_inicio->dataref; ?>', <?php echo $row_lin_inicio->total; ?> ],            
                                 <?php }     ?>    
                                 ];      

    var data_LinCusPac = [
                                  ['Data Referência', 'Total'],   
                                   <?php while ($row_lin_custo_paciente = $query_lin_custo_paciente->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_custo_paciente->dataref; ?>', <?php echo $row_lin_custo_paciente->total; ?> ],            
                                 <?php }     ?>      
                                 ];     

    var data_LinNeg = [
                                   ['Data Referência', 'Total a Receber', 'Total em Atraso', 'Total Pago'],
                                    <?php while ($row_lin_negociacao = $query_lin_negociacao->fetch_object()) {
                                  ?>
                                ['<?php echo $row_lin_negociacao->dataref; ?>',<?php echo $row_lin_negociacao->total_a_receber; ?>    ,<?php echo $row_lin_negociacao->total_em_atraso; ?>,<?php echo $row_lin_negociacao->total_pago; ?> ],
                                <?php } ?>
                                 ];

    var data_LinAssXFal = [
                             ['Data Referência', 'Assíduos', 'Faltosos'],
                                  <?php while ($row_lin_tratamento_assiduos_faltosos = $query_lin_tratamento_assiduos_faltosos->fetch_object()) {
                                ?>
                              ['<?php echo $row_lin_tratamento_assiduos_faltosos->dataref; ?>',<?php echo $row_lin_tratamento_assiduos_faltosos->total_assiduos; ?>    ,<?php echo $row_lin_tratamento_assiduos_faltosos->total_faltosos; ?>],        
                              <?php } ?>
                 ];

    var data_LinFluPac = [
                             ['Data Referência', 'Total'],
                                  <?php while ($row_lin_fluxo_paciente = $query_busca_lin_fluxo_paciente->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_fluxo_paciente->dataref; ?>', <?php echo $row_lin_fluxo_paciente->total; ?> ],            
                                 <?php }     ?>
    ];

    var data_LinIniXOrc = [
                               ['Data Referência', 'Orçamentos', 'Inícios', 'Proporção Inícios x Orçamentos'],
                              <?php while ($row_lin_tratamento_inicio_x_orcamento = $query_lin_tratamento_inicio_x_orcamento->fetch_object()) {
                            ?>
                          ['<?php echo $row_lin_tratamento_inicio_x_orcamento->dataref; ?>',<?php echo $row_lin_tratamento_inicio_x_orcamento->orcamentos; ?>    ,<?php echo $row_lin_tratamento_inicio_x_orcamento->inicios; ?>,<?php echo $row_lin_tratamento_inicio_x_orcamento->proporcao; ?> ],
                          <?php } ?>
    ];

    var data_LinCompRecDesp = [
                                 ['Data Referência', 'Receita', 'Despesas', 'Lucro'],
                                  <?php while ($row_lin_comparativo_receita_despesas = $query_lin_comparativo_receita_despesas->fetch_object()) {
                                ?>
                              ['<?php echo $row_lin_comparativo_receita_despesas->dataref; ?>',<?php echo $row_lin_comparativo_receita_despesas->receita; ?>    ,<?php echo $row_lin_comparativo_receita_despesas->despesa; ?>,<?php echo $row_lin_comparativo_receita_despesas->lucro; ?> ],        
                              <?php } ?>
    ];


    startDrawingLinAgAss = function(){
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
 
        function drawChart() {
            var data = google.visualization.arrayToDataTable(data_LinAgAss);
 
            var options = {
              title: 'Agendados Assíduos',
              is3D: true,         
            };
            var chart = new google.visualization.AreaChart(document.getElementById('lin_agendados_assiduos'));
            chart.draw(data, options);
        }
    };   

    startDrawingLinAgFal = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});

      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_LinAgFal);

        var options = {
          title: 'Agendados Faltosos',
         
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_agendados_faltosos'));
        chart.draw(data, options);
      }
    };   

    startDrawingLinAtAss = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_LinAtAss);

        var options = {
          title: 'Atendidos Assíduos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_atendidos_assiduos'));
        chart.draw(data, options);
      }
   };            

    startDrawingLinAtFal = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinAtFal);

      var options = {
          title: 'Atendidos Faltosos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

       var chart = new google.visualization.AreaChart(document.getElementById('lin_atendidos_faltosos'));
        chart.draw(data, options);
      }  
    };  

    startDrawingLinFluFM = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinFluFM);

      var options = {
          title: 'Fluxo FM',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };
      var chart = new google.visualization.AreaChart(document.getElementById('lin_fluxo_fm'));
        chart.draw(data, options);
      }
    };   

    startDrawingLinFlut = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinFlut); 

       var options = {
          title: 'Flutuantes',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_flutuantes'));
        chart.draw(data, options);
      }
    };  

     startDrawingLinOrc = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinOrc); 


        var options = {
          title: 'Orçamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_orcamentos'));
        chart.draw(data, options);
      }
     }; 

    startDrawingLinDoc = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinDoc); 

       var options = {
          title: 'Documentação',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_documentacao'));
        chart.draw(data, options);
      }
  };

    startDrawingLinIni = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinIni); 

        var options = {
          title: 'Inícios',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_inicio'));
        chart.draw(data, options);
      }
  };

    startDrawingLinCusPac = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinCusPac); 

      var options = {
          title: 'Custo Paciente',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_custo_paciente'));
        chart.draw(data, options);
      }
    };  

    startDrawingLinNeg = function(){                          
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinNeg); 

        var options = {
            title: 'Negociação',
            hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
          };
          var chart = new google.visualization.AreaChart(document.getElementById('lin_negociacao'));
          chart.draw(data, options);
        }
    };

    startDrawingLinAssXFal = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinAssXFal); 
       var options = {
          title: 'Tratamento Assíduos x Faltosos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_tratamento_assiduos_faltosos'));
        chart.draw(data, options);
      }
    };

    startDrawingLinFluPac = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinFluPac); 

        var options = {
          title: 'Fluxo Paciente',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_fluxo_paciente'));
        chart.draw(data, options);
      }
    };

     startDrawingLinIniXOrc = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinIniXOrc); 

        var options = {
          title: 'Tratamento Inícios x Orçamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_tratamento_inicio_x_orcamento'));
        chart.draw(data, options);
      }
  };

   startDrawingLinCompRecDesp = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
          function drawChart() {
          var data = google.visualization.arrayToDataTable(data_LinCompRecDesp); 

          var options = {
          title: 'Comparativo Receita Despesas',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          curveType: 'function',
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_comparativo_receita_despesas'));
        chart.draw(data, options);
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
                    <h1 class="page-header">Gráficos Mês a Mês - <?php echo $nomefantasia;?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
               
                <!-- /.col-lg-12 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">                             
                            Agendados Assíduos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="lin_agendados_assiduos" style="width:100%;height:100%;"></div>
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
                            Agendados Faltosos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="lin_agendados_faltosos" style="width:100%;height:100%;"></div>
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
                                <div id="lin_atendidos_assiduos" style="width:100%;height:100%;"></div>
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
                                <div id="lin_atendidos_faltosos" style="width:100%;height:100%;"></div>
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
                                <div id="lin_flutuantes" style="width:100%;height:100%;"></div>
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
                              <div id="lin_fluxo_fm" style="width:100%;height:100%;"></div>
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
                                <div id="lin_orcamentos" style="width:100%;height:100%;"></div>
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
                                <div id="lin_documentacao" style="width:100%;height:100%;"></div>
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
                                <div id="lin_inicio" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                     <!-- /.col-lg-6 --><!-- /.panel -->
                      <!-- /.col-lg-6 -->
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Custo Paciente
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="lin_custo_paciente" style="width:100%;height:100%;"></div>
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
                                <div id="lin_negociacao" style="width:100%;height:100%;"></div>
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
                                <div id="lin_tratamento_assiduos_faltosos" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Fluxo Paciente

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                              <div id="lin_fluxo_paciente" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Proporção Inícios x Orçamentos

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="lin_tratamento_inicio_x_orcamento" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Comparativo Receitas x Despesas

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="lin_comparativo_receita_despesas" style="width:100%;height:100%;"></div>
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
