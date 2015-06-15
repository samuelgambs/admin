<?php

session_start();

include "functions.php";

session_checker();
require_once('../includes/mysqli.php');

$idclinica = ($_GET['idclinica']);
$busca_nome = "SELECT nomefantasia, cnpj
FROM ap_clinicas
WHERE idclinica = '$idclinica'
AND tipoclinica = 'F'";
$query_busca_nome = $MySQLi->query($busca_nome) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_nome = $query_busca_nome->fetch_object();
$nomefantasia =  $row_busca_nome->nomefantasia;
$id = $row_busca_nome->cnpj;
if (strlen($id) > 11 )
$id = substr($id,0,8);
else
$id = substr($id,0,9);

$busca_lin_comparativo_receita_despesas2 =
"SELECT dataref,
		receita, despesa,lucro,
        data_arquivo
   FROM cli_lin_comparativo_receita_despesas
   WHERE INSCRICAO = $id
   AND date(data_arquivo) BETWEEN ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1) 
   AND date(now()) 
   ORDER BY data_arquivo";
$query_lin_comparativo_receita_despesas2 =  $MySQLi->query($busca_lin_comparativo_receita_despesas2) or trigger_error($MySQLi->error, E_USER_ERROR);
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title><?php echo $nomefantasia?> Comparativo de Receitas e Despesas</title>
 	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

     window.onload = function(){
        
		     
		           startDrawingLinReceitas();
		       };


		    	window.onresize = function(){	
		    		 startDrawingLinReceitas();
			       };       
		      
		       var data_LinCompRecDesp = [
		                                  ['Data Referência', 'Receita', 'Despesas', 'Lucro'],
		                                   <?php while ($row_lin_comparativo_receita_despesas = $query_lin_comparativo_receita_despesas2->fetch_object()) {
		                                 ?>
		                               ['<?php echo $row_lin_comparativo_receita_despesas->dataref; ?>',<?php echo $row_lin_comparativo_receita_despesas->receita; ?>    ,<?php echo $row_lin_comparativo_receita_despesas->despesa; ?>,<?php echo $row_lin_comparativo_receita_despesas->lucro; ?> ],        
		                               <?php } ?>
		     ];

	 startDrawingLinReceitas = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinCompRecDesp);


        var options = {
          title: '<?php echo $nomefantasia?>  Comparativo de Receitas e Despesas',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
         
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_receitas'));
        chart.draw(data, options);
      }
     };
    </script>

</head>
<body class="page">
  <div id="lin_receitas"></div>
</body>
</html>




