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
$label = 'Índice de Faltas';
$icon = 'fa-bar-chart-o';
$flag = 'ma-invertido';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];



	$sql_busca_indice_faltas = "
	SELECT qtd_falta_mes, qtd_marcacoes_mes, indice_falta
	FROM cli_indice_falta xx
	WHERE INSCRICAO = $id
	AND xx.data_inclusao =   (SELECT max(x.data_inclusao)
	FROM cli_indice_falta x
	WHERE  x.INSCRICAO = xx.INSCRICAO limit 1)";
	
	$query_busca_indice_faltas = $MySQLi->query($sql_busca_indice_faltas) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_busca_indice_faltas = $query_busca_indice_faltas->fetch_object();
	$qtd_falta_mes = $row_busca_indice_faltas->qtd_falta_mes;
	$qtd_marcacoes_mes = $row_busca_indice_faltas->qtd_marcacoes_mes;
	$indice_falta = $row_busca_indice_faltas->indice_falta;
	
	$sql_busca_indice_faltas_regional = "
	SELECT
	AVG(ze.qtd_falta_mes) as qtd_falta_mes, AVG(ze.qtd_marcacoes_mes) as qtd_marcacoes_mes, AVG(ze.indice_falta) as indice_falta
	FROM ap_clinicas a
	LEFT JOIN (SELECT  qtd_falta_mes, qtd_marcacoes_mes, indice_falta, inscricao
	FROM cli_indice_falta  xx
	WHERE xx.data_inclusao =   (SELECT max(x.data_inclusao)
	FROM cli_indice_falta x
	WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) ZE ON ZE.INSCRICAO = CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	
	 
	WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim' AND a.estado = '$estado' ";
	$query_busca_indice_faltas_regional = $MySQLi->query($sql_busca_indice_faltas_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_busca_indice_faltas_regional = $query_busca_indice_faltas_regional->fetch_object();
	$media_qtd_falta_mes_regional = $row_busca_indice_faltas_regional->qtd_falta_mes;
	$media_qtd_marcacoes_mes_regional = $row_busca_indice_faltas_regional->qtd_marcacoes_mes;
	$media_indice_falta_regional = $row_busca_indice_faltas_regional->indice_falta;
	
	
	$sql_busca_indice_faltas_nacional = "
	SELECT
	AVG(ze.qtd_falta_mes) as qtd_falta_mes , AVG(ze.qtd_marcacoes_mes) as qtd_marcacoes_mes, AVG(ze.indice_falta)   as indice_falta
	FROM ap_clinicas a
	LEFT JOIN (SELECT  qtd_falta_mes, qtd_marcacoes_mes, indice_falta, inscricao
	FROM cli_indice_falta  xx
	WHERE xx.data_inclusao =   (SELECT max(x.data_inclusao)
	FROM cli_indice_falta x
	WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) ZE ON ZE.INSCRICAO = CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	
	
	WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'  ";
	$query_busca_indice_faltas_nacional = $MySQLi->query($sql_busca_indice_faltas_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_busca_indice_faltas_nacional = $query_busca_indice_faltas_nacional->fetch_object();
	$media_qtd_falta_mes_nacional = $row_busca_indice_faltas_nacional->qtd_falta_mes;
	$media_qtd_marcacoes_mes_nacional = $row_busca_indice_faltas_nacional->qtd_marcacoes_mes;
	$media_indice_falta_nacional = $row_busca_indice_faltas_nacional->indice_falta;

echo montaPanel($label, $indice_falta, $indice_falta, $media_indice_falta_regional, $media_indice_falta_nacional, $indice_falta,
		$icon, $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $indice_falta, $pacientes_nacional, $pacientes_regional);



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
