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
$label = 'Cancelamentos';
$icon = 'fa-ban';
$flag = 'ma-invertido';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];

/////QUANTIDADE cancelamento

$sql_busca_lin_cancelamento_ficha =
"SELECT dataref,
total
FROM cli_lin_cancelamento_ficha
WHERE INSCRICAO = $id
ORDER BY data_arquivo desc
LIMIT 1      ";

$query_busca_lin_cancelamento_ficha = $MySQLi->query($sql_busca_lin_cancelamento_ficha) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_lin_cancelamento_ficha = $query_busca_lin_cancelamento_ficha->fetch_object();
$cancelamento_ficha_parcial_mes = $row_lin_cancelamento_ficha->total;



$sql_busca_lin_cancelamento_ficha_mp =
"SELECT dataref,
total
FROM cli_lin_cancelamento_ficha
WHERE INSCRICAO = $id
AND  dataref = '$mespassado'
ORDER BY data_arquivo desc
LIMIT 1";

$query_busca_lin_cancelamento_ficha_mp = $MySQLi->query($sql_busca_lin_cancelamento_ficha_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_lin_cancelamento_ficha_mp = $query_busca_lin_cancelamento_ficha_mp->fetch_object();
$cancelamento_ficha_mp = $row_lin_cancelamento_ficha_mp->total;

	$sql_busca_lin_cancelamento_ficha_regional =
	"SELECT avg(total) as total
	FROM cli_lin_cancelamento_ficha xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE A.estado = '$estado' and  dataref = '$mesatual'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	
	$query_soma_cancelamento_ficha_regional = $MySQLi->query($sql_busca_lin_cancelamento_ficha_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_cancelamento_ficha_regional =   $query_soma_cancelamento_ficha_regional->fetch_object();
	$cancelamento_ficha_regional = $row_cancelamento_ficha_regional->total;
	
	$sql_busca_lin_cancelamento_ficha_nacional=
	"SELECT avg(total) as total
	FROM cli_lin_cancelamento_ficha xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mesatual'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	$query_soma_cancelamento_ficha_nacional = $MySQLi->query($sql_busca_lin_cancelamento_ficha_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_cancelamento_ficha_nacional = $query_soma_cancelamento_ficha_nacional->fetch_object();
	$cancelamento_ficha_nacional = $row_cancelamento_ficha_nacional->total;

if ($dados=='ma') {
	$flag = 'ma-invertido';

echo montaPanel($label, $cancelamento_ficha_parcial_mes, $cancelamento_ficha_parcial_mes, $cancelamento_ficha_regional, $cancelamento_ficha_nacional, $cancelamento_ficha_mp,
		 $icon, $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $pacientes_mes_parcial, $pacientes_nacional, $pacientes_regional);
	
	
}
else {
	$flag = 'mp-invertido';
	
	$sql_busca_lin_cancelamento_ficha_regional =
	"SELECT avg(total) as total
	FROM cli_lin_cancelamento_ficha xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE A.estado = '$estado' and  dataref = '$mespassado'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	
	$query_soma_cancelamento_ficha_regional = $MySQLi->query($sql_busca_lin_cancelamento_ficha_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_cancelamento_ficha_regional =   $query_soma_cancelamento_ficha_regional->fetch_object();
	$cancelamento_ficha_regional = $row_cancelamento_ficha_regional->total;
	
	$sql_busca_lin_cancelamento_ficha_nacional=
	"SELECT avg(total) as total
	FROM cli_lin_cancelamento_ficha xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mespassado'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	$query_soma_cancelamento_ficha_nacional = $MySQLi->query($sql_busca_lin_cancelamento_ficha_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_cancelamento_ficha_nacional = $query_soma_cancelamento_ficha_nacional->fetch_object();
	$cancelamento_ficha_nacional = $row_cancelamento_ficha_nacional->total;

	echo montaPanel($label, $cancelamento_ficha_mp, $cancelamento_ficha_parcial_mes, $cancelamento_ficha_regional, $cancelamento_ficha_nacional, $cancelamento_ficha_mp,
			$icon, $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $pacientes_mes_parcial, $pacientes_nacional, $pacientes_regional);
	
	
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
