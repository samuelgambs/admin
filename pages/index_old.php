<?php 
require_once('../includes/queries.php');
require_once('../includes/graphs.php');
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
</style>
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

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="logo" href="index.php?id=<?php echo $id?>"><img class="img-responsive" src="../logo.png" alt=""/></a>
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
            <div class="navbar-default sidebar" role="navigation">
              <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                  <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                      <input type="text" class="form-control" placeholder="Search...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i></button>
                      </span></div>
                    <!-- /input-group -->
                  </li>
                  <li> <a href="index.php?id=<?php echo $id ?>"><i class="fa fa-dashboard fa-fw"></i> Painel</a></li>
                  <li> <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Gráficos<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li> <a href="flot.php?id=<?php echo $id ?>">Gráficos</a></li>
                      <li> <a href="linha.php?id=<?php echo $id ?>">Detalhado Mês a Mês</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                  </li>
                  <li> <a href="tables.php?id=<?php echo $id ?>"><i class="fa fa-table fa-fw"></i> Tabelas</a></li>
                   
                         <li>
                            <a href="clinicas.php?id=<?php echo $id ?>"><i class="fa fa-sitemap fa-fw"></i>Clínicas<span class="fa arrow"></span></a>
                            
               
                </li>
                </ul>
              </div>
              <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Clínica <?php echo $nomefantasia;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                
                  <div class="panel panel-<?php if ($lucro > 0) {
                        echo "primary"; }
                        else {
                            echo "red";
                        } ?>">   
                    <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    
                              </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">R$<?php echo number_format($lucro, 2, ',', '.');  ?></div>
                                    <div align="left">Lucro</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                  
                              </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">R$<?php echo number_format($receita, 2, ',', '.');  ?></div>
                                    <div align="left">Receita</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   
                              </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">R$<?php echo number_format($despesa, 2, ',', '.');  ?></div>
                                    <div align="left">Despesa</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    
                              </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">R$<?php echo number_format($nao_ira_receber, 2, ',', '.');  ?></div>
                                    <div align="left">Não serão recebidos</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Comparativo Receita e Despesas
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                              </div>
                          </div>
                          
                      </div>
                      
                        <!-- /.panel-heading -->
                        <div class="grid">
                            <div id="lin_comparativo_receita_despesas"  style="width:100%; height:400px"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Proporção Inícios x Orçamentos
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                    <div class="panel-body">
                      <div class="row">
                        
                        <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="inicio" style="width:100%; height:50%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                        <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="orcamentos" style="width:100%; height:50%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                            <div class="col-lg-4">
                              <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                  <thead>
                                    <tr>
                                      <th>Período</th>
                                      <th>Orçamentos</th>
                                      <th>Inícios</th>
                                      <th>%</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>Mês Anterior</td>
                                      <td><?php echo $orc_mespassado;?></td>
                                      <td><?php echo $ini_mespassado;?></td>
                                      <td><?php echo $porc_mespassado;?></td>
                                    </tr>
                                    <tr>
                                      <td>Mês Atual</td>
                                      <td><?php echo $orc_mesatual;?></td>
                                      <td><?php echo $ini_mesatual;?></td>
                                      <td><?php echo $porc_mesatual;?></td>
                                    </tr>
                                    <tr>
                                      <td>Total</td>
                                      <td><?php echo $orcamento_total;?></td>
                                      <td><?php echo $inicio_total;?></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          <!-- /.col-lg-4 (nested) -->
                          <!-- /.col-lg-8 (nested) -->
                        </div>
                            <!-- /.row -->
                      </div>
                      <!-- /.panel-body -->
                       
                   
                    <!-- /.panel --><!-- /.panel -->
                </div>
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Tratamento Assíduos x Faltosos
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                    <div class="panel-body">
                      <div class="row">
                        
                        <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="agendados_assiduos" style="width:100%; height:50%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                            <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="atendidos_assiduos" style="width:100%; height:50%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                            <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="tratamento_assiduos" style="width:100%; height:50%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                            <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="agendados_faltosos" style="width:100%; height:50%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                           <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="atendidos_faltosos" style="width:100%; height:50%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                            <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="tratamento_faltosos" style="width:100%; height:50%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                              <div class="col-lg-4">
                                     <div class="panel-body">
                             <div id="assiduos_x_faltosos" style="width:100%; height:100%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                                    <!-- /.table-responsive -->
                          </div>
                          
                          <div class="col-lg-4">
                                    <div class="">
                                        <table width="220%" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Período</th>
                                                    <th>Assíduos</th>
                                                    <th>Faltosos</th>
                                                    <th>Tratamento Assíduos</th>
                                                    <th>Tratamento Faltosos</th>
                                                    <th>Assíduos x Faltosos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Agendados</td>
                                                    <td><?php echo $assiduos_a1;?></td>
                                                    <td><?php echo $faltosos_b1;?></td>
                                                    <td><?php echo $taagendados;?></td>
                                                    <td><?php echo $faltosos_agendados; ?></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Atendidos</td>
                                                    <td><?php echo $assiduos_c1;?></td>
                                                    <td><?php echo $faltosos_d1;?></td>
                                                    <td><?php echo $taatendidos;?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td>Total</td>
                                                  <td><?php echo $assiduos_a2;?></td>
                                                  <td><?php echo $faltosos_b2;?></td>
                                                  
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                        </div>
                     
                          <!-- /.col-lg-4 (nested) -->
                          <!-- /.col-lg-8 (nested) -->
                        </div>
                            <!-- /.row -->
                      </div>
                      <!-- /.panel-body -->
                       
                   
                    <!-- /.panel --><!-- /.panel -->
                </div>
                    
                    
                    <!-- /.panel --><!-- /.panel --><!-- /.panel -->
                </div>
                
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                     <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                              </div>
                          </div>
                        <div class="panel-heading">Negociação</div>
                        
                        
                        
                        
                        <div class="panel-body">
                            <div id="negociacao" style="width:100%; height:80%"></div>
                           
                          <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Custo Paciente</div>
                        <div class="panel-body">
                             <div id="custo_paciente" style="width:100%; height:80%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Envelhecimento Clínica</div>
                        <div class="panel-body">
                             <div id="envelhecimento" style="width:100%; height:80%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Fluxo FM</div>
                        <div class="panel-body">
                             <div id="fluxo_fm" style="width:100%; height:80%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Flutuantes</div>
                        <div class="panel-body">
                             <div id="flutuantes" style="width:100%; height:80%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Documentação</div>
                        <div class="panel-body">
                             <div id="documentacao" style="width:100%; height:80%"></div>

                          <a href="#" class="btn btn-default btn-block">Ver Detalhes</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel --><!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
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

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
