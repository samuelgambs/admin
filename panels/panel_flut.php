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
$label = 'Flutuantes';
$icon = 'fa-random';
$flag = 'ma-invertido';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];

if ($dados=='ma') {

 
$busca_lin_flutuantes =
"SELECT dataref,
total
FROM cli_lin_flutuantes
WHERE INSCRICAO = $id
ORDER BY data_arquivo desc
LIMIT 1";
$query_lin_flutuantes = $MySQLi->query($busca_lin_flutuantes) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_flutuantes_ma = $query_lin_flutuantes->fetch_object();
$flutuantes_ma= $row_flutuantes_ma->total;

$busca_parcial_flutuantes_mp =
"SELECT   qtd_flutuantes, data_inclusao
FROM cli_flutuantes
WHERE INSCRICAO = $id
AND date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)
limit 1";
$query_parcial_flutuantes_mp = $MySQLi->query($busca_parcial_flutuantes_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_parcial_flutuantes_mp = $query_parcial_flutuantes_mp->fetch_object();
$parcial_flutuantes_mp= $row_parcial_flutuantes_mp->qtd_flutuantes;
$data_inclusao_mp = $row_parcial_flutuantes_mp->data_inclusao;

$sql_busca_regional_flutuantes_ma = 
"SELECT avg(total) as total
FROM cli_lin_flutuantes xx
INNER JOIN ap_clinicas A
ON xx.INSCRICAO =  CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END

WHERE A.estado = '$estado' and  dataref = '$mesatual' and tipoclinica = 'F' and ativo ='sim' ";
$query_busca_regional_flutuantes_ma = $MySQLi->query($sql_busca_regional_flutuantes_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_flutuantesregional_ma = $query_busca_regional_flutuantes_ma->fetch_object();
$flutuantes_regional_ma = $row_flutuantesregional_ma->total;

$sql_busca_nacional_flutuantes_ma =
"SELECT avg(total) as total
FROM cli_lin_flutuantes xx
INNER JOIN ap_clinicas A
ON xx.INSCRICAO =  CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END

WHERE   dataref = '$mesatual' and tipoclinica = 'F' and ativo ='sim' ";
$query_busca_nacional_flutuantes_ma = $MySQLi->query($sql_busca_nacional_flutuantes_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_flutuantesnacional_ma = $query_busca_nacional_flutuantes_ma->fetch_object();
$flutuantes_nacional_ma = $row_flutuantesnacional_ma->total;


echo montaPanel($label, $flutuantes_ma, $flutuantes_ma, $flutuantes_regional_ma, $flutuantes_nacional_ma, $parcial_flutuantes_mp, $icon, $flag,
		 $total_pac_mes_passado, $pacientes_mes_parcial, $data_inclusao_mp, $pacientes_nacional, $pacientes_regional);
}
else {

	$flag = 'invertido';
	$busca_flutuantes_mes_passado =  "SELECT dataref,
	total
	FROM cli_lin_flutuantes
	WHERE INSCRICAO = $id
	ORDER BY data_arquivo desc
	LIMIT 1,1 ";
	$query_flutuantes_mes_passado = $MySQLi->query($busca_flutuantes_mes_passado) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_flutuantes_mes_passado = $query_flutuantes_mes_passado->fetch_object();
	$flutuantes_mes_passado = $row_flutuantes_mes_passado->total;

$sql_busca_nacional_flutuantes_mp =
"SELECT avg(total) as total
FROM cli_lin_flutuantes xx
INNER JOIN ap_clinicas A
ON xx.INSCRICAO =  CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END

WHERE   dataref = '$mespassado' and tipoclinica = 'F' and ativo ='sim' ";
$query_busca_nacional_flutuantes_mp = $MySQLi->query($sql_busca_nacional_flutuantes_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_flutuantesnacional_mp = $query_busca_nacional_flutuantes_mp->fetch_object();
$flutuantes_nacional_mp = $row_flutuantesnacional_mp->total;


$sql_busca_regional_flutuantes_mp =
"SELECT avg(total) as total
FROM cli_lin_flutuantes xx
INNER JOIN ap_clinicas A
ON xx.INSCRICAO =  CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END

WHERE A.estado = '$estado' and  dataref = '$mespassado' and tipoclinica = 'F' and ativo ='sim' ";
$query_busca_regional_flutuantes_mp = $MySQLi->query($sql_busca_regional_flutuantes_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_flutuantesregional_mp = $query_busca_regional_flutuantes_mp->fetch_object();
$flutuantes_regional_mp = $row_flutuantesregional_mp->total;



echo montaPanel($label, $flutuantes_mes_passado, $flutuantes_mes_passado, $flutuantes_regional_mp, $flutuantes_nacional_mp, $flutuantes_mes_passado, $icon, $flag,
		 $total_pac_mes_passado, $pacientes_mes_parcial, $flutuantes_mes_passado, $pacientes_nacional, $pacientes_regional);
	
	
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
