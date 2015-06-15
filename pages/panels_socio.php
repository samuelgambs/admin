<?php session_start();

include "functions.php";

session_checker();?>

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rede Odonto - Acesso Restrito</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="../stylesheet" type="text/css" href="../css/default.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <br>
               
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        <i class="fa  fa-bullhorn"></i>
                            Comunicados
                        </div>
                        <div class="panel-body">
                            <p>Não existem novos comunicados.</p>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                        <i class="fa  fa-file-zip-o"></i>
                            Arquivos
                        </div>
                        <div class="panel-body">
                            <p>Não existem novos itens a exibir.</p>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                        <i class="fa fa-calendar"></i>
                            Calendário
                        </div>
                        <div class="panel-body">
                            <p></p>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        <i class="fa fa-exclamation-circle"></i>
                            Novidades
                        </div>
                        <div class="panel-body">
                            <p>Não há ítens para exibir</p>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                        <i class="fa fa-edit"></i>
                            Enquete
                        </div>
                        <div class="panel-body">
                            <p>Não existem novos itens a exibir.</p>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                        <i class="fa fa-youtube"></i>
                            Vídeos
                        </div>
                        <div class="panel-body">
                            <p></p>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
            <!-- /.row -->
            <div class="row">

                 <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        <i class="fa fa-weixin"></i>
                            Fale Conosco
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post" action="index.php">
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Setor</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Departamento" value="">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="human" class="col-sm-2 control-label">Assunto</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="human" name="human" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message" class="col-sm-2 control-label">Texto:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="4" name="message"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <input id="submit" name="submit" type="submit" value="Enviar" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <script language="JavaScript" type="text/javascript">
              parent.document.getElementById("panels").height = document.getElementById("page-wrapper").scrollHeight + 40; //40: Margem Superior e Inferior, somadas
            </script>


