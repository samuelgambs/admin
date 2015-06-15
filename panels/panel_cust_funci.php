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
$label = 'Custo Funcionário';
$icon = 'fa-user-md';
$flag = 'valor';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];


//CUSTO FUNCIONARIO


$sql_busca_custo_funcionario_parcial_mes =
"SELECT valor, dataref
FROM cli_lin_custo_funcionario a
WHERE inscricao = $id
ORDER BY data_arquivo desc
LIMIT 12      ";
$query_busca_custo_funcionario_parcial_mes =  $MySQLi->query($sql_busca_custo_funcionario_parcial_mes) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_custo_funcionario_parcial_mes = $query_busca_custo_funcionario_parcial_mes->fetch_object();

	if (!empty($row_custo_funcionario_parcial_mes->total))
	$custo_funcionario_valor = $row_custo_funcionario_parcial_mes->valor;
	else $custo_funcionario_valor = 0;


	$sql_busca_custo_funcionario_mp =
	"SELECT valor
	FROM cli_lin_custo_funcionario xx
	WHERE inscricao = $id
	AND  dataref = '$mespassado'
	ORDER BY data_arquivo desc
	LIMIT 12";
	$query_busca_custo_funcionario_mp =  $MySQLi->query($sql_busca_custo_funcionario_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_custo_funcionario_mp = $query_busca_custo_funcionario_mp->fetch_object();
	/* if (!empty($row_custo_funcionario_parcial_mes->total)) */
	$custo_funcionario_valor_mp = $row_custo_funcionario_mp->valor;
	/* else $custo_funcionario_valor_mp = 0;
	*/
	

if ($dados=='ma') {
	$sql_soma_nacional_custo_funcionario =
	"SELECT sum(valor) as valor
	FROM cli_lin_custo_funcionario xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mesatual'";
	
	$query_soma_nacional_custo_funcionario =  $MySQLi->query($sql_soma_nacional_custo_funcionario) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_nacional_custo_funcionario = $query_soma_nacional_custo_funcionario->fetch_object();
	$custo_funcionario_valor_nacional = $row_soma_nacional_custo_funcionario->valor;
	
	$sql_soma_regional_custo_funcionario =
	"SELECT sum(valor) as valor
	FROM cli_lin_custo_funcionario xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE A.estado = '$estado' and  dataref = '$mesatual'";
	
	$query_soma_regional_custo_funcionario =  $MySQLi->query($sql_soma_regional_custo_funcionario) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_regional_custo_funcionario = $query_soma_regional_custo_funcionario->fetch_object();
	$custo_funcionario_valor_regional = $row_soma_regional_custo_funcionario->valor;

 echo montaPanel($label, $custo_funcionario_valor, $custo_funcionario_valor, $custo_funcionario_valor_regional, $custo_funcionario_valor_nacional, $custo_funcionario_valor_mp, $icon,
 		 $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $custo_funcionario_valor_mp, $pacientes_nacional, $pacientes_regional);
}
else {
	$sql_soma_nacional_custo_funcionario =
	"SELECT sum(valor) as valor
	FROM cli_lin_custo_funcionario xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mespassado'";
	
	$query_soma_nacional_custo_funcionario =  $MySQLi->query($sql_soma_nacional_custo_funcionario) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_nacional_custo_funcionario = $query_soma_nacional_custo_funcionario->fetch_object();
	$custo_funcionario_valor_nacional = $row_soma_nacional_custo_funcionario->valor;
	
	$sql_soma_regional_custo_funcionario =
	"SELECT sum(valor) as valor
	FROM cli_lin_custo_funcionario xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE A.estado = '$estado' and  dataref = '$mespassado'";
	
	$query_soma_regional_custo_funcionario =  $MySQLi->query($sql_soma_regional_custo_funcionario) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_regional_custo_funcionario = $query_soma_regional_custo_funcionario->fetch_object();
	$custo_funcionario_valor_regional = $row_soma_regional_custo_funcionario->valor;

 echo montaPanel($label, $custo_funcionario_valor_mp, $custo_funcionario_valor, $custo_funcionario_valor_regional, $custo_funcionario_valor_nacional, $custo_funcionario_valor_mp, $icon,
 		 $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $custo_funcionario_valor_mp, $pacientes_nacional, $pacientes_regional);
	
	
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
