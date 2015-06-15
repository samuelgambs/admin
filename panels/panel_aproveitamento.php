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
$label = 'Aproveitamento';
$icon = 'fa-file-text';
$flag = 'ma-invertido';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];



	$sql_busca_aproveitamento = "
	SELECT total
	FROM cli_indice_nota_fiscal xx
	WHERE INSCRICAO = $id
	AND xx.data_inclusao =   (SELECT max(x.data_inclusao)
	FROM cli_indice_nota_fiscal x
	WHERE  x.INSCRICAO = xx.INSCRICAO limit 1)";
	
	$query_busca_aproveitamento = $MySQLi->query($sql_busca_aproveitamento) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_busca_aproveitamento = $query_busca_aproveitamento->fetch_object();
	$aproveitamento = $row_busca_aproveitamento->total;
	
	
	$sql_busca_aproveitamento_regional = "
			
	SELECT
	AVG(ze.total) as total
	FROM ap_clinicas a
	LEFT JOIN (SELECT  total, inscricao
	FROM cli_indice_nota_fiscal  xx
	WHERE xx.data_inclusao =   (SELECT max(x.data_inclusao)
	FROM cli_indice_nota_fiscal x
	WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) ZE ON ZE.INSCRICAO = CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	
	 
	WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim' AND a.estado = '$estado' ";
	$query_busca_aproveitamento_regional = $MySQLi->query($sql_busca_aproveitamento_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_busca_aproveitamento_regional = $query_busca_aproveitamento_regional->fetch_object();
	$media_aproveitamento_regional = $row_busca_aproveitamento_regional->total;

	
	
	$sql_busca_aproveitamento_nacional = "
		SELECT
	AVG(ze.total) as total
	FROM ap_clinicas a
	LEFT JOIN (SELECT  total, inscricao
	FROM cli_indice_nota_fiscal  xx
	WHERE xx.data_inclusao =   (SELECT max(x.data_inclusao)
	FROM cli_indice_nota_fiscal x
	WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) ZE ON ZE.INSCRICAO = CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	
	 
	WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'";
	$query_busca_aproveitamento_nacional = $MySQLi->query($sql_busca_aproveitamento_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_busca_aproveitamento_nacional = $query_busca_aproveitamento_nacional->fetch_object();
	$media_aproveitamento_nacional = $row_busca_aproveitamento_nacional->total;
	
	$busca_parcial_aproveitamento_mp =
	"SELECT   total, data_inclusao
	FROM cli_indice_nota_fiscal
	WHERE INSCRICAO = $id
	AND date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)
	limit 1";
	$query_parcial_aproveitamento_mp = $MySQLi->query($busca_parcial_aproveitamento_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_parcial_aproveitamento_mp = $query_parcial_aproveitamento_mp->fetch_object();
	$parcial_aproveitamento_mp= $row_parcial_aproveitamento_mp->total;
	
	echo montaPanel($label, $aproveitamento, $aproveitamento, $media_aproveitamento_regional, $media_aproveitamento_nacional, $aproveitamento,
			 $icon, $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $aproveitamento, $pacientes_nacional, $pacientes_regional);


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
