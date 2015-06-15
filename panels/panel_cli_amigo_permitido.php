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

$bandeira = array(
		'AM'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Bandeira_do_Amazonas.svg/125px-Bandeira_do_Amazonas.svg.png',
		'DF'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Bandeira_do_Distrito_Federal_%28Brasil%29.svg/125px-Bandeira_do_Distrito_Federal_%28Brasil%29.svg.png',
		'BA'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Bandeira_da_Bahia.svg/125px-Bandeira_da_Bahia.svg.png',
		'BR'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/125px-Flag_of_Brazil.svg.png',
		'ES'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Bandeira_do_Esp%C3%ADrito_Santo.svg/125px-Bandeira_do_Esp%C3%ADrito_Santo.svg.png',
		'GO'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Bandeira_de_Goi%C3%A1s.svg/125px-Bandeira_de_Goi%C3%A1s.svg.png',
		'MG'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Bandeira_de_Minas_Gerais.svg/125px-Bandeira_de_Minas_Gerais.svg.png',
		'PR'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Bandeira_do_Paran%C3%A1.svg/125px-Bandeira_do_Paran%C3%A1.svg.png',
		'RJ'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Bandeira_da_cidade_do_Rio_de_Janeiro.svg/125px-Bandeira_da_cidade_do_Rio_de_Janeiro.svg.png',
		'RS'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/6/63/Bandeira_do_Rio_Grande_do_Sul.svg/125px-Bandeira_do_Rio_Grande_do_Sul.svg.png',
		'SC'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Bandeira_de_Santa_Catarina.svg/125px-Bandeira_de_Santa_Catarina.svg.png',
		'SP'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Bandeira_do_estado_de_S%C3%A3o_Paulo.svg/125px-Bandeira_do_estado_de_S%C3%A3o_Paulo.svg.png'
);

$id = $_GET['id'];
$regional = $_GET['regional'];
$estado = $regional;
$dados = $_GET['dados'];
$label = 'Permitidos';
$icon = 'fa-randon';

$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];




$sql_busca_cliente_amigo_ma =
"SELECT dataref, total_indic,total_contemplado,total_permitido
FROM cli_lin_cliente_amigo a
WHERE inscricao = $id
ORDER BY data_arquivo desc
LIMIT 1 ";

$query_busca_cliente_amigo_ma = $MySQLi->query($sql_busca_cliente_amigo_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_cliente_amigo_ma = $query_busca_cliente_amigo_ma->fetch_object();
$cliente_amigo_total_permitido_ma =  $row_busca_cliente_amigo_ma->total_permitido;



	$sql_busca_cliente_amigo_mp =
	"SELECT dataref, total_indic,total_contemplado,total_permitido
	FROM cli_lin_cliente_amigo xx
	WHERE inscricao = $id
	AND  dataref = '$mespassado'";
	$query_busca_cliente_amigo_mp = $MySQLi->query($sql_busca_cliente_amigo_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_busca_cliente_amigo_mp = $query_busca_cliente_amigo_mp->fetch_object();
	$cliente_amigo_total_permitido_mp =  $row_busca_cliente_amigo_mp->total_permitido;
	

	$sql_media_nacional_cliente_amigo_mp =
	"SELECT AVG(total_indic) as total_indic, AVG(total_permitido) as total_permitido
	FROM cli_lin_cliente_amigo xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mespassado'";
	$query_media_nacional_cliente_amigo_mp = $MySQLi->query($sql_media_nacional_cliente_amigo_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_media_nacional_cliente_amigo_mp = $query_media_nacional_cliente_amigo_mp->fetch_object();
	$cliente_amigo_total_permitido_nacional_mp =  $row_media_nacional_cliente_amigo_mp->total_permitido;

	$sql_media_regional_cliente_amigo_mp =
	"SELECT AVG(total_indic) as total_indic, AVG(total_permitido) as total_permitido
			FROM cli_lin_cliente_amigo xx
			INNER JOIN ap_clinicas A
			ON xx.INSCRICAO =  CASE
			WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
			ELSE substring(a.CNPJ,1,9)
			END
			WHERE A.estado = '$estado' and  dataref = '$mespassado'";
			$query_media_regional_cliente_amigo_mp = $MySQLi->query($sql_media_regional_cliente_amigo_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
			$row_media_regional_cliente_amigo_mp = $query_media_regional_cliente_amigo_mp->fetch_object();
			$cliente_amigo_total_permitido_regional_mp =  $row_media_regional_cliente_amigo_mp->total_permitido;
			
			$icon = 'fa-comments';

if ($dados=='ma') {
	$flag = 'ma';
	
	$sql_media_nacional_cliente_amigo_ma =
	"SELECT AVG(total_indic) as total_indic, AVG(total_permitido) as total_permitido
	FROM cli_lin_cliente_amigo xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE dataref = '$mesatual'";
	$query_media_nacional_cliente_amigo_ma = $MySQLi->query($sql_media_nacional_cliente_amigo_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_media_nacional_cliente_amigo_ma = $query_media_nacional_cliente_amigo_ma->fetch_object();
	$cliente_amigo_total_permitido_nacional_ma =  $row_media_nacional_cliente_amigo_ma->total_permitido;
	$cliente_amigo_total_indic_nacional_ma = $row_media_nacional_cliente_amigo_ma->total_indic;
	
	$sql_media_regional_cliente_amigo_ma =
	"SELECT AVG(total_indic) as total_indic, AVG(total_contemplado) as total_contemplado, AVG(total_permitido) as total_permitido 
	FROM cli_lin_cliente_amigo xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	WHERE A.estado = '$estado' and  dataref = '$mesatual'";
	$query_media_regional_cliente_amigo_ma = $MySQLi->query($sql_media_regional_cliente_amigo_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_media_regional_cliente_amigo_ma = $query_media_regional_cliente_amigo_ma->fetch_object();
	$cliente_amigo_total_contemplado_regional_ma =  $row_media_regional_cliente_amigo_ma->total_contemplado;
	$cliente_amigo_total_indic_regional_ma = $row_media_regional_cliente_amigo_ma->total_indic;
	$cliente_amigo_total_permitido_regional_ma = $row_media_regional_cliente_amigo_ma->total_permitido;
	
	
	$sql_pmp ="SELECT total_indic,total_contemplado, inscricao, data_inclusao as data_cliente_amigo_pmp, total_permitido
	FROM cli_cliente_amigo  xx
	WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO";
	$query_pmp = $MySQLi->query($sql_pmp) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row = $query_pmp->fetch_object();
	$var_parcial_mp = $row->total_permitido;
	$data_inclusao_mp = $row->data_cliente_amigo_pmp;
	
	echo montaPanel($label, $cliente_amigo_total_permitido_ma, $cliente_amigo_total_permitido_ma, $cliente_amigo_total_permitido_regional_ma, 
			$cliente_amigo_total_permitido_nacional_ma,
			 $var_parcial_mp, $icon, $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $data_inclusao_mp, $pacientes_nacional, $pacientes_regional);

 
}
else { 
	$flag = 'normal';
	
	echo montaPanel($label, $cliente_amigo_total_permitido_mp, $cliente_amigo_total_permitido_ma, $cliente_amigo_total_permitido_regional_mp,
			 $cliente_amigo_total_permitido_nacional_mp, $pacientes_nacional, $icon, $flag, $total_pac_mes_passado, 
			$pacientes_mes_parcial, $cliente_amigo_total_permitido_ma, $pacientes_nacional, $pacientes_regional);
	

}

?>
<script type="text/javascript">
$('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})
</script>
