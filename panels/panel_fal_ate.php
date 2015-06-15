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
$label = 'Atendidos';
$icon = 'fa-facebook';
$flag = 'ma-invertido';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];

if ($dados=='ma') {
$sql_busca_qtde_faltosos_ma =
"SELECT dataref,
    total, faltosos_agendados, faltosos_atendidos
   FROM cli_lin_qtde_faltosos
   WHERE INSCRICAO = $id 
   AND  dataref = '$mesatual'
   ORDER BY data_arquivo desc
   LIMIT 1";
 $query_busca_qtde_faltosos_ma = $MySQLi->query($sql_busca_qtde_faltosos_ma) or trigger_error($MySQLi->error, E_USER_ERROR); 
 $row_qtde_faltosos_ma =   $query_busca_qtde_faltosos_ma->fetch_object(); 
 $qtde_faltosos_ma = $row_qtde_faltosos_ma->total;
 $faltosos_agendados_ma = $row_qtde_faltosos_ma->faltosos_agendados;
 $faltosos_atendidos_ma = $row_qtde_faltosos_ma->faltosos_atendidos;
 
 $sql_soma_qtde_faltosos_regional=
 "SELECT avg(total) as total,  avg(faltosos_agendados) as faltosos_agendados,  avg(faltosos_atendidos) as faltosos_atendidos
 FROM cli_lin_qtde_faltosos xx
 INNER JOIN ap_clinicas A
 ON xx.INSCRICAO =  CASE
					 WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
					 ELSE substring(a.CNPJ,1,9)
					END

 WHERE A.estado = '$estado' and  dataref = '$mesatual'";
 $query_soma_qtde_faltosos_regional = $MySQLi->query($sql_soma_qtde_faltosos_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_qtde_faltosos_regional =   $query_soma_qtde_faltosos_regional->fetch_object();
 $qtde_faltosos_regional_ma = $row_qtde_faltosos_regional->total;
 $faltosos_agendados_regional_ma = $row_qtde_faltosos_regional->faltosos_agendados;
 $faltosos_atendidos_regional_ma = $row_qtde_faltosos_regional->faltosos_atendidos;
 
 $sql_soma_qtde_faltosos_nacional=
 "SELECT AVG(total) as total, avg(faltosos_agendados) as faltosos_agendados,  avg(faltosos_atendidos) as faltosos_atendidos
 FROM cli_lin_qtde_faltosos xx
 INNER JOIN ap_clinicas A
 ON xx.INSCRICAO =  CASE
					 WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
					 ELSE substring(a.CNPJ,1,9)
					END
 
 
 WHERE dataref = '$mesatual'
 and a.ativo = 'Sim' and a.tipoclinica = 'F' ";
 $query_soma_qtde_faltosos_nacional = $MySQLi->query($sql_soma_qtde_faltosos_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_qtde_faltosos_nacional =   $query_soma_qtde_faltosos_nacional->fetch_object();
 $qtde_faltosos_nacional_ma = $row_qtde_faltosos_nacional->total;
 $faltosos_agendados_nacional_ma = $row_qtde_faltosos_nacional->faltosos_agendados;
 $faltosos_atendidos_nacional_ma = $row_qtde_faltosos_nacional->faltosos_atendidos;
 
 $sql_busca_parcial_faltosos_atendidos_mp =
 "SELECT  faltosos_d1, faltosos_d2, data_inclusao, faltosos_porc
 FROM cli_atendidos_faltosos
 WHERE INSCRICAO = $id
 AND date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)
 limit 1";
 $query_busca_parcial_faltosos_atendidos_mp = $MySQLi->query($sql_busca_parcial_faltosos_atendidos_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_busca_parcial_faltosos_atendidos_mp = $query_busca_parcial_faltosos_atendidos_mp->fetch_object();
 $parcial_faltosos_atendidos_mp = $row_busca_parcial_faltosos_atendidos_mp->faltosos_d1;
 $parcial_porc_faltosos_atendidos_mp = $row_busca_parcial_faltosos_atendidos_mp->faltosos_porc;
 $data_inclusao_mp = $row_busca_parcial_faltosos_atendidos_mp->data_inclusao;
 

 $sql_soma_qtde_faltosos_regional=
 "SELECT avg(total) as total,  avg(faltosos_agendados) as faltosos_agendados,  avg(faltosos_atendidos) as faltosos_atendidos
 FROM cli_lin_qtde_faltosos xx
 INNER JOIN ap_clinicas A
 ON xx.INSCRICAO =  CASE
 WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
 ELSE substring(a.CNPJ,1,9)
 END
 
 WHERE A.estado = '$estado' and  dataref = '$mesatual'";
 $query_soma_qtde_faltosos_regional = $MySQLi->query($sql_soma_qtde_faltosos_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_qtde_faltosos_regional =   $query_soma_qtde_faltosos_regional->fetch_object();
 $qtde_faltosos_regional_ma = $row_qtde_faltosos_regional->total;
 $faltosos_agendados_regional_ma = $row_qtde_faltosos_regional->faltosos_agendados;
 $faltosos_atendidos_regional_ma = $row_qtde_faltosos_regional->faltosos_atendidos;
 
 $sql_soma_qtde_faltosos_nacional=
 "SELECT AVG(total) as total, avg(faltosos_agendados) as faltosos_agendados,  avg(faltosos_atendidos) as faltosos_atendidos
 FROM cli_lin_qtde_faltosos xx
 INNER JOIN ap_clinicas A
 ON xx.INSCRICAO =  CASE
 WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
 ELSE substring(a.CNPJ,1,9)
 END
 
 
 WHERE dataref = '$mesatual'
 and a.ativo = 'Sim' and a.tipoclinica = 'F' ";
 $query_soma_qtde_faltosos_nacional = $MySQLi->query($sql_soma_qtde_faltosos_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_qtde_faltosos_nacional =   $query_soma_qtde_faltosos_nacional->fetch_object();
 $qtde_faltosos_nacional_ma = $row_qtde_faltosos_nacional->total;
 $faltosos_agendados_nacional_ma = $row_qtde_faltosos_nacional->faltosos_agendados;
 $faltosos_atendidos_nacional_ma = $row_qtde_faltosos_nacional->faltosos_atendidos;



echo montaPanel($label, $faltosos_atendidos_ma, $faltosos_atendidos_ma, $faltosos_atendidos_regional_ma, $faltosos_atendidos_nacional_ma, $parcial_faltosos_atendidos_mp, $icon, $flag,
		 $qtde_faltosos_ma, $qtde_faltosos_ma, $data_inclusao_mp, $qtde_faltosos_nacional_ma, $qtde_faltosos_regional_ma);
}
else {
	$flag = 'invertido';
	$sql_busca_qtde_faltosos_mp =
	"SELECT dataref,
	total, faltosos_agendados, faltosos_atendidos
	FROM cli_lin_qtde_faltosos
	WHERE INSCRICAO = $id
	AND  dataref = '$mespassado'
	ORDER BY data_arquivo desc
	LIMIT 1";
	$query_busca_qtde_faltosos_mp = $MySQLi->query($sql_busca_qtde_faltosos_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_qtde_faltosos_mp =   $query_busca_qtde_faltosos_mp->fetch_object();
	$qtde_faltosos_mp = $row_qtde_faltosos_mp->total;
	$faltosos_agendados_mp = $row_qtde_faltosos_mp->faltosos_agendados;
	$faltosos_atendidos_mp = $row_qtde_faltosos_mp->faltosos_atendidos;
	
	$sql_soma_qtde_faltosos_regional=
	"SELECT avg(total) as total,  avg(faltosos_agendados) as faltosos_agendados,  avg(faltosos_atendidos) as faltosos_atendidos
	FROM cli_lin_qtde_faltosos xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	
	WHERE A.estado = '$estado' and  dataref = '$mespassado'";
	$query_soma_qtde_faltosos_regional = $MySQLi->query($sql_soma_qtde_faltosos_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_qtde_faltosos_regional =   $query_soma_qtde_faltosos_regional->fetch_object();
	$qtde_faltosos_regional_mp = $row_qtde_faltosos_regional->total;
	$faltosos_agendados_regional_mp = $row_qtde_faltosos_regional->faltosos_agendados;
	$faltosos_atendidos_regional_mp = $row_qtde_faltosos_regional->faltosos_atendidos;
	
	$sql_soma_qtde_faltosos_nacional=
	"SELECT AVG(total) as total, avg(faltosos_agendados) as faltosos_agendados,  avg(faltosos_atendidos) as faltosos_atendidos
			FROM cli_lin_qtde_faltosos xx
			INNER JOIN ap_clinicas A
			ON xx.INSCRICAO =  CASE
			WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
			ELSE substring(a.CNPJ,1,9)
			END
	
			WHERE dataref = '$mespassado'
			and a.ativo = 'Sim' and a.tipoclinica = 'F' ";
			$query_soma_qtde_faltosos_nacional = $MySQLi->query($sql_soma_qtde_faltosos_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
			$row_qtde_faltosos_nacional = $query_soma_qtde_faltosos_nacional->fetch_object();
			$qtde_faltosos_nacional_mp = $row_qtde_faltosos_nacional->total;
			$faltosos_agendados_nacional_mp = $row_qtde_faltosos_nacional->faltosos_agendados;
			$faltosos_atendidos_nacional_mp = $row_qtde_faltosos_nacional->faltosos_atendidos;
			
			

			$sql_soma_qtde_faltosos_regional=
			"SELECT avg(total) as total
			FROM cli_lin_qtde_faltosos xx
			INNER JOIN ap_clinicas A
			ON xx.INSCRICAO =  CASE
			WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
			ELSE substring(a.CNPJ,1,9)
			END
			
			
			WHERE A.estado = '$estado' and  dataref = '$mespassado'";
			$query_soma_qtde_faltosos_regional = $MySQLi->query($sql_soma_qtde_faltosos_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
			$row_qtde_faltosos_regional =   $query_soma_qtde_faltosos_regional->fetch_object();
			$qtde_faltosos_regional = $row_qtde_faltosos_regional->total;
			
			
		
				
			
			
			echo montaPanel($label, $faltosos_atendidos_mp, $faltosos_atendidos_mp, $faltosos_atendidos_regional_mp, $faltosos_atendidos_nacional_mp, $faltosos_atendidos_nacional_mp, 
					$icon, $flag, $qtde_faltosos_mp, $qtde_faltosos_mp, $pacientes_nacional, $qtde_faltosos_nacional_mp, $qtde_faltosos_regional_mp);
	
	
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
