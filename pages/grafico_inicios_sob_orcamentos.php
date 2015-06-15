<?php

session_start();

include "functions.php";

session_checker();
require_once('../includes/mysqli.php');

$idclinica = ($_GET['idclinica']);
$busca_nome = "SELECT nomefantasia, cnpj, estado
FROM ap_clinicas
WHERE idclinica = '$idclinica'
AND tipoclinica = 'F'";
$query_busca_nome = $MySQLi->query($busca_nome) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_nome = $query_busca_nome->fetch_object();
$nomefantasia =  $row_busca_nome->nomefantasia;
$estado =  $row_busca_nome->estado;
$id = $row_busca_nome->cnpj;
if (strlen($id) > 11 )
$id = substr($id,0,8);
else
$id = substr($id,0,9);

$busca_lin_inicio2 =
"SELECT a.dataref,a.total as orcamentos, b.total as inicios, b.total/a.total*100 as proporcao, a.data_arquivo
FROM cli_lin_orcamento a
INNER JOIN (SELECT dataref,total,data_arquivo, inscricao FROM cli_lin_inicio) b on b.inscricao = a.inscricao and a.dataref = b.dataref
WHERE a.INSCRICAO = $id
AND date(a.data_arquivo) BETWEEN ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1)
AND date(now())
ORDER BY a.data_arquivo";
$query_lin_inicio2 = $MySQLi->query($busca_lin_inicio2) or trigger_error($MySQLi->error, E_USER_ERROR);
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title><?php echo $nomefantasia?> Inícios sob Orçamentos</title>
 	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
	
	    window.onload = function(){            
			           				 startDrawingLinIni();
			      							 };

		window.onresize = function(){	  
									 startDrawingLinIni();
									 };					 
		      
  var data_LinIniXOrc = [
                               ['Data Referência', 'Orçamentos', 'Inícios', 'Proporção Inícios x Orçamentos'],
                              <?php while ($row_lin_inicio_x_orcamento = $query_lin_inicio2->fetch_object()) {
                            ?>
                          ['<?php echo $row_lin_inicio_x_orcamento->dataref; ?>',<?php echo $row_lin_inicio_x_orcamento->orcamentos; ?>    ,<?php echo $row_lin_inicio_x_orcamento->inicios; ?>,<?php echo round($row_lin_inicio_x_orcamento->proporcao); ?>  ],
                          <?php } ?>
    ];


	  startDrawingLinIni = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinIniXOrc);


        var options = {
          title: '<?php echo $nomefantasia?> Histórico de Aproveitamento de Orçamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.LineChart(document.getElementById('lin_inicios'));
        chart.draw(data, options);
      }
     };
     google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawTable);

      function drawTable() {
          var data = google.visualization.arrayToDataTable(data_LinIniXOrc);
       

        var table = new google.visualization.Table(document.getElementById('tab_fluxo_paciente'));

        table.draw(data, {showRowNumber: true});
      }
    </script>

</head>
<body class="page">
  <div id="lin_inicios"></div>
     <center><div id="tab_fluxo_paciente"></div></center>

</body>
</html>




