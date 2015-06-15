<?php
/* 
 * 
$usuario_id =$_SESSION['usuario_id'];
 */
require_once('../includes/mysqli.php');

//include "functions.php";

if (isset($_GET['idclinica'])) {
$sqlbuscaclinicas =  "SELECT t1.nomefantasia,t1.idclinica
FROM ( SELECT a.nomefantasia,a.idclinica
FROM ap_clinicas a
WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'
GROUP BY substring(a.CNPJ,1,8) 
ORDER BY nomefantasia ) T1
INNER JOIN ap_clinica_socios T ON T.idClinica = T1.IdClinica
WHERE T.idSocio = '$usuario_id' " ;
$query_busca_clinicas = $MySQLi->query($sqlbuscaclinicas) or trigger_error($MySQLi->error, E_USER_ERROR);}
else {
	$sqlbuscaclinicas =  " SELECT a.nomefantasia,a.idclinica
	FROM ap_clinicas a
	WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'" ;
	$query_busca_clinicas = $MySQLi->query($sqlbuscaclinicas) or trigger_error($MySQLi->error, E_USER_ERROR);
	
}

include "functions.php";
session_start();
session_checker();
error_reporting(E_ALL);

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
</head>

<body>

    <div id="wrapper">
            <?php  include '../includes/navigation.php';?>



        <div id="page-wrapper">

            <div class="row">
            <center>
            
                                         <div class="form-group" style="position:relative;top:50px">
                                            <select class="form-control" style="width:200px" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
  
                                            <option>Clínicas...</option>
                                        <?php while ($row_busca_clinicas = $query_busca_clinicas->fetch_object()) { ?>
                                                <option value="index.php?idclinica=<?php echo $row_busca_clinicas->idclinica;?>"><?php echo ucfirst(strtolower($row_busca_clinicas->nomefantasia))?></option>
                                        <?php  } ?> 
                                            </select>
                                        </div>

               </center>
            </div>
            </div>
            </div>
             



    <!-- /#wrapper -->

    <!-- jQuery -->
   
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
  
    

</body>

</html>
