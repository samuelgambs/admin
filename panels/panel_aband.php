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
$label = 'Abandono';
$icon = 'fa-times';
$flag = 'ma-invertido';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];



/* LEFT JOIN (SELECT INSCRICAO, abandono_trat, indice_abandono, MAX(data_inclusao) AS data_inclusao
FROM cli_indice_abandono XX
WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) AB22 ON AB22.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END */

if ($dados=='ma') {
$sql_busca_qtde_abandono_ma =
"    SELECT INSCRICAO, abandono_trat, indice_abandono
FROM cli_indice_abandono XX
 WHERE INSCRICAO = $id
 ORDER BY data_inclusao desc
LIMIT 1  ";
 $query_busca_qtde_abandono_ma = $MySQLi->query($sql_busca_qtde_abandono_ma) or trigger_error($MySQLi->error, E_USER_ERROR); 
 $row_qtde_abandono_ma =   $query_busca_qtde_abandono_ma->fetch_object(); 
 $abandono_trat_ma = $row_qtde_abandono_ma->abandono_trat;
 $indice_abandono_ma = $row_qtde_abandono_ma->indice_abandono;
 
 $sql_soma_qtde_abandono_regional =
 "SELECT avg(total_abandono) as abandono_trat,  avg(indice_abandono) as indice_abandono
 FROM cli_lin_indice_abandono xx
 INNER JOIN ap_clinicas A
 ON xx.INSCRICAO =  CASE
					 WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
					 ELSE substring(a.CNPJ,1,9)
					END

 WHERE A.estado = '$estado' and  dataref = '$mesatual'
 and a.tipoclinica = 'F' and a.ativo ='sim'";
 $query_soma_qtde_abandono = $MySQLi->query($sql_soma_qtde_abandono_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_qtde_faltosos_ma =   $query_soma_qtde_abandono->fetch_object();
 $abandono_trat_ma_regional = $row_qtde_faltosos_ma->abandono_trat;
 $indice_abandono_ma_regional = $row_qtde_faltosos_ma->indice_abandono;
 
 $sql_soma_qtde_abandono_nacional =
 "SELECT avg(total_abandono) as abandono_trat,  avg(indice_abandono) as indice_abandono
 FROM cli_lin_indice_abandono xx
 INNER JOIN ap_clinicas A
 ON xx.INSCRICAO =  CASE
					 WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
					 ELSE substring(a.CNPJ,1,9)
					END

 WHERE   dataref = '$mesatual'
 and a.tipoclinica = 'F' and a.ativo ='sim'";
 $query_soma_qtde_abandono = $MySQLi->query($sql_soma_qtde_abandono_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_qtde_faltosos_ma =   $query_soma_qtde_abandono->fetch_object();
 $abandono_trat_ma_nacional = $row_qtde_faltosos_ma->abandono_trat;
 $indice_abandono_ma_nacional = $row_qtde_faltosos_ma->indice_abandono;
 
 $sql_busca_parcial_abandono_mp =
 "SELECT INSCRICAO, abandono_trat, indice_abandono, MAX(data_inclusao) AS data_inclusao
 FROM cli_indice_abandono XX
 WHERE INSCRICAO = $id
 AND date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO";
 $query_busca_parcial_abandono_mp = $MySQLi->query($sql_busca_parcial_abandono_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_busca_parcial_abandono_mp = $query_busca_parcial_abandono_mp->fetch_object();
 $parcial_abandono_mp = $row_busca_parcial_abandono_mp->abandono_trat;
 $parcial_indice_abandono_mp = $row_busca_parcial_abandono_mp->indice_abandono;
 $data_inclusao_mp = $row_busca_parcial_abandono_mp->data_inclusao;


echo montaPanel($label, $abandono_trat_ma, $indice_abandono_ma, $abandono_trat_ma_regional, $abandono_trat_ma_nacional, $parcial_abandono_mp, $icon, $flag,
	 $total_pac_mes_passado, $pacientes_mes_parcial, $data_inclusao_mp, $pacientes_nacional, $pacientes_regional);
}
else {
	$flag = 'invertido';
	$sql_busca_qtde_abandono_mp =
	
	"    SELECT INSCRICAO, abandono_trat, indice_abandono
	FROM cli_indice_abandono XX
	WHERE INSCRICAO = $id
	ORDER BY data_inclusao desc
	LIMIT 1,1  ";
	$query_busca_qtde_abandono_mp = $MySQLi->query($sql_busca_qtde_abandono_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_qtde_abandono_mp =   $query_busca_qtde_abandono_mp->fetch_object();
	$abandono_trat_mp = $row_qtde_abandono_mp->abandono_trat;
	$indice_abandono_mp = $row_qtde_abandono_mp->indice_abandono;
	
	

	$sql_soma_qtde_abandono_regional =
	"SELECT avg(total_abandono) as abandono_trat,  avg(indice_abandono) as indice_abandono
	FROM cli_lin_indice_abandono xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	
	WHERE A.estado = '$estado' and  dataref = '$mespassado'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	$query_soma_qtde_abandono = $MySQLi->query($sql_soma_qtde_abandono_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_qtde_faltosos_ma =   $query_soma_qtde_abandono->fetch_object();
	$abandono_trat_mp_regional = $row_qtde_faltosos_ma->abandono_trat;
	$indice_abandono_mp_regional = $row_qtde_faltosos_ma->indice_abandono;
	
	$sql_soma_qtde_abandono_nacional =
	"SELECT avg(total_abandono) as abandono_trat,  avg(indice_abandono) as indice_abandono
	FROM cli_lin_indice_abandono xx
	INNER JOIN ap_clinicas A
	ON xx.INSCRICAO =  CASE
	WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
	ELSE substring(a.CNPJ,1,9)
	END
	
	WHERE   dataref = '$mespassado'
	and a.tipoclinica = 'F' and a.ativo ='sim'";
	$query_soma_qtde_abandono = $MySQLi->query($sql_soma_qtde_abandono_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
	$row_qtde_faltosos_ma =   $query_soma_qtde_abandono->fetch_object();
	$abandono_trat_mp_nacional = $row_qtde_faltosos_ma->abandono_trat;
	$indice_abandono_mp_nacional = $row_qtde_faltosos_ma->indice_abandono;
	
			
			echo montaPanel($label, $indice_abandono_mp, $indice_abandono_mp, $abandono_trat_mp_regional, $abandono_trat_mp_nacional, $indice_abandono_mp_nacional, $icon, $flag,
	 $total_pac_mes_passado, $pacientes_mes_parcial, $indice_abandono_mp, $pacientes_nacional, $pacientes_regional);
	
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
