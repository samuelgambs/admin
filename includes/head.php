<?php
session_start();

include "../pages/functions.php";

session_checker();
/*
echo "Bem vindo <strong>". $_SESSION['nome'] ." </strong>! <br />
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
error_reporting(E_ALL); ?>


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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo $_SESSION['nome'] ?></a>
                        </li>
                        <?php if (($_SESSION['cod_usuario'] != 6)) { ?>
                        <li><a data-toggle="modal" data-target="#modal_cadastro" href="#modal_cadastro" id="button_cadastro">

                        <i class="fa fa-plus fa-fw"></i>Cadastro de Usuários</a>

                        </li>
                        <?php }?>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
             <?php //include '../includes/menu.php'; ?>
            <!-- /.navbar-static-side -->
        </nav>
        </div>
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
        <iframe name="head" src="../pages/filtro.php?" width="100%" frameborder=0 scrolling=no height="100%" ></iframe>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script language="javascript"> 
    $('#modal_cadastro').on('shown.bs.modal',function(){      //correct here use 'shown.bs.modal' event which comes in bootstrap3
        $(this).find('iframe').attr('src','../pages/formulario_cadastro.php?tipouser=<?php echo ($_SESSION['cod_usuario'])?>')
      }) 
       
    </script>

        </body>
        </html>
