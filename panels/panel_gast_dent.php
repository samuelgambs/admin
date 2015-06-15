<?php
error_reporting(E_ALL);

require_once('../includes/mysqli.php');
require_once('../pages/functions.php');
$meses = array(
		'01'=>'Jan',
		'02'=>'Fev',
		'03'=>'Mar',
		'04'=>'Abr',
		'05'=>'Mai',
		'06'=>'Jun',
		'07'=>'Jul',
		'08'=>'Ago',
		'09'=>'Set',
		'10'=>'Out',
		'11'=>'Nov',
		'12'=>'Dez'
);

$mespassado =  $meses[date ('m', strtotime(date('Y-m')." -1 month"))].'/'.date ('Y', strtotime(date('Y-m')." -1 month"));
$mesatual = $meses[date ('m', strtotime(date('Y-m')))].'/'.date ('Y', strtotime(date('Y-m')));

$id = $_GET['id'];
$regional = $_GET['regional'];
$estado = $regional;
$dados = $_GET['dados'];
$label = 'Gasto Dental';
$icon = 'fa-medkit';
$flag = 'valor';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];


/////////////////////GASTOS DENTAL
$sql_busca_gastos_dental =
"SELECT total, dataref
FROM cli_lin_gastos_dental a
WHERE inscricao = $id
ORDER BY data_arquivo desc
LIMIT 12 ";
$query_busca_gastos_dental = $MySQLi->query($sql_busca_gastos_dental) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_gastos_dental = $query_busca_gastos_dental->fetch_object();
if (!empty($row_busca_gastos_dental->total))
	$gastos_dental_parcial_mes =  $row_busca_gastos_dental->total;
	else $gastos_dental_parcial_mes = 0;


	$sql_busca_gastos_dental_mp =
	"SELECT total, dataref
	FROM cli_lin_gastos_dental xx
	WHERE inscricao = $id
	AND  dataref = '$mespassado'
	ORDER BY data_arquivo desc
	LIMIT 12";
	$query_busca_gastos_dental_mp = $MySQLi->query($sql_busca_gastos_dental_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_busca_gastos_dental_mp = $query_busca_gastos_dental_mp->fetch_object();
	if (!empty($row_busca_gastos_dental_mp->total))
		$gastos_dental_mp =  $row_busca_gastos_dental_mp->total;
		else
			$gastos_dental_mp = 0;

			

if ($dados=='ma') {
	
	$sql_soma_nacional_gastos_dental =
	
	"SELECT sum(total) as total
	FROM cli_lin_gastos_dental xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mesatual'";
	$query_soma_nacional_gastos_dental = $MySQLi->query($sql_soma_nacional_gastos_dental) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_gastos_dental_nacional = $query_soma_nacional_gastos_dental->fetch_object();
	$gastos_dental_total_nacional =  $row_soma_gastos_dental_nacional->total;
	
	
	$sql_soma_regional_gastos_dental =
	"SELECT sum(total) as total
			FROM cli_lin_gastos_dental xx
			INNER JOIN ap_clinicas A
			ON xx.INSCRICAO =  CASE
			WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
			ELSE substring(a.CNPJ,1,9)
			END
	
			WHERE A.estado = '$estado' and  dataref = '$mesatual'";
			$query_soma_regional_gastos_dental = $MySQLi->query($sql_soma_regional_gastos_dental) or trigger_error($MySQLi->error, E_USER_ERROR);
			$row_soma_gastos_dental_regional = $query_soma_regional_gastos_dental->fetch_object();
			$gastos_dental_total_regional =  $row_soma_gastos_dental_regional->total;

 echo montaPanel($label, $gastos_dental_parcial_mes, $gastos_dental_parcial_mes, $gastos_dental_total_regional, $gastos_dental_total_nacional, $gastos_dental_parcial_mes, $icon, 
 		$flag, $total_pac_mes_passado, $pacientes_mes_parcial, $gastos_dental_parcial_mes, $pacientes_nacional, $pacientes_regional);


}
else {
	$sql_soma_nacional_gastos_dental =
	
	"SELECT sum(total) as total
	FROM cli_lin_gastos_dental xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mespassado'";
	$query_soma_nacional_gastos_dental = $MySQLi->query($sql_soma_nacional_gastos_dental) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_gastos_dental_nacional = $query_soma_nacional_gastos_dental->fetch_object();
	$gastos_dental_total_nacional =  $row_soma_gastos_dental_nacional->total;
	
	
	$sql_soma_regional_gastos_dental =
	"SELECT sum(total) as total
	FROM cli_lin_gastos_dental xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	
	WHERE A.estado = '$estado' and  dataref = '$mespassado'";
	$query_soma_regional_gastos_dental = $MySQLi->query($sql_soma_regional_gastos_dental) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_gastos_dental_regional = $query_soma_regional_gastos_dental->fetch_object();
	$gastos_dental_total_regional =  $row_soma_gastos_dental_regional->total;

 
	echo montaPanel($label, $gastos_dental_mp, $gastos_dental_parcial_mes, $gastos_dental_total_regional, $gastos_dental_total_nacional, $gastos_dental_parcial_mes, $icon,
			$flag, $total_pac_mes_passado, $pacientes_mes_parcial, $gastos_dental_parcial_mes, $pacientes_nacional, $pacientes_regional);
	
	
}


/* 
  if (mysqli_num_rows($resultado) > "0")
    {
} */


?>
<script type="text/javascript">
$('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})
</script>
