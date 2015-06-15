<?php 
session_start();

include "functions.php";

session_checker();
?>
<!DOCTYPE html>
<html lang="pt">

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

<body class="cbp-spmenu-push">
<div id="wrapper" style="height:100%">
     <!-- Navigation -->
        <?php  include '../includes/navigation.php';?>
         <div>
         	<iframe src="panels_socio.php" frameborder="0" scrolling="no" name="panels" width="100%" height="100%" id="panels">  </iframe>
		</div>
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
							    $('#modal_cadastro').on('shown.bs.modal',function(){      //correct here use 'shown.bs.modal' event which comes in bootstrap3
							        $(this).find('iframe').attr('src','../pages/formulario_cadastro.php?tipouser=<?php echo ($_SESSION['cod_usuario'])?>')
							      }) 
							       $('#modal_senha').on('shown.bs.modal',function(){      //correct here use 'shown.bs.modal' event which comes in bootstrap3
							        $(this).find('iframe').attr('src','../pages/formulario_nova_senha.php?tipouser=<?php echo ($_SESSION['cod_usuario'])?>')
							      }) 
							       
							    </script>
							    

</body>

</html>
