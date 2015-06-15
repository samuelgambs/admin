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
$label = 'Suspensões';
$icon = 'fa-warning';
$flag = 'ma-invertido';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];




//SUSPENSOES
$sql_busca_suspensoes_parcial_mes =
"SELECT dataref, valor, quantidade
FROM cli_lin_suspensao a
WHERE inscricao = $id
ORDER BY data_arquivo desc
LIMIT 12";

$query_busca_suspensoes_parcial_mes =  $MySQLi->query($sql_busca_suspensoes_parcial_mes) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_suspensoes_parcial_mes = $query_busca_suspensoes_parcial_mes->fetch_object();
$suspensao_valor = $row_suspensoes_parcial_mes->valor;
$suspensao_quantidade = $row_suspensoes_parcial_mes->quantidade;


$sql_busca_suspensoes_mp =
"SELECT dataref, valor, quantidade
FROM cli_lin_suspensao xx
WHERE inscricao = $id
AND  dataref = '$mespassado'
ORDER BY data_arquivo desc
LIMIT 12";
$query_busca_suspensoes_mp =  $MySQLi->query($sql_busca_suspensoes_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_suspensoes_mp = $query_busca_suspensoes_mp->fetch_object();
if (!empty($row_suspensoes_mp->total))
	$suspensao_valor_mp = $row_suspensoes_mp->valor;
	else $suspensao_valor_mp = 0;
	if (!empty($row_suspensoes_mp->quantidade))
		$suspensao_quantidade_mp = $row_suspensoes_mp->quantidade;
		else 	  $suspensao_quantidade_mp = 0;

	

if ($dados=='ma') {
	$sql_soma_nacional_suspensoes =
	"SELECT AVG(valor) as valor ,AVG(quantidade) as quantidade
	FROM cli_lin_suspensao xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mesatual'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	
	$query_soma_nacional_suspensoes =  $MySQLi->query($sql_soma_nacional_suspensoes) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_nacional_suspensoes = $query_soma_nacional_suspensoes->fetch_object();
	$suspensoes_quantidade_nacional = $row_soma_nacional_suspensoes->quantidade;
	$suspensoes_valor_nacional = $row_soma_nacional_suspensoes->valor;
	
	$sql_soma_regional_suspensoes =
	"SELECT AVG(valor) as valor ,AVG(quantidade) as quantidade
	FROM cli_lin_suspensao xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE A.estado = '$estado' and  dataref = '$mesatual'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	$query_soma_regional_suspensoes =  $MySQLi->query($sql_soma_regional_suspensoes) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_regional_suspensoes = $query_soma_regional_suspensoes->fetch_object();
	$suspensoes_quantidade_regional = $row_soma_regional_suspensoes->quantidade;
	$suspensoes_valor_regional = $row_soma_regional_suspensoes->valor;

echo montaPanel($label, $suspensao_quantidade, $suspensao_quantidade, $suspensoes_quantidade_regional, $suspensoes_quantidade_nacional, $suspensao_quantidade, $icon,
		 $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $suspensoes_valor_regional, $pacientes_nacional, $pacientes_regional);
}
else {
	$flag = 'invertido';
	
	$sql_soma_nacional_suspensoes =
	"SELECT AVG(valor) as valor ,AVG(quantidade) as quantidade
	FROM cli_lin_suspensao xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mespassado'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	
	$query_soma_nacional_suspensoes =  $MySQLi->query($sql_soma_nacional_suspensoes) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_nacional_suspensoes = $query_soma_nacional_suspensoes->fetch_object();
	$suspensoes_quantidade_nacional = $row_soma_nacional_suspensoes->quantidade;
	$suspensoes_valor_nacional = $row_soma_nacional_suspensoes->valor;
	
	$sql_soma_regional_suspensoes =
	"SELECT AVG(valor) as valor, AVG(quantidade) as quantidade
	FROM cli_lin_suspensao xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE A.estado = '$estado' and  dataref = '$mespassado'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	$query_soma_regional_suspensoes =  $MySQLi->query($sql_soma_regional_suspensoes) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_soma_regional_suspensoes = $query_soma_regional_suspensoes->fetch_object();
	$suspensoes_quantidade_regional = $row_soma_regional_suspensoes->quantidade;
	$suspensoes_valor_regional = $row_soma_regional_suspensoes->valor;

 

echo montaPanel($label, $suspensao_quantidade_mp, $suspensao_quantidade, $suspensoes_quantidade_regional, $suspensoes_quantidade_nacional, $suspensao_quantidade, $icon,
		 $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $suspensoes_valor_regional, $pacientes_nacional, $pacientes_regional);
	
	
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
