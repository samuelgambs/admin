<?php
error_reporting(E_ALL);

require_once('../includes/mysqli.php');
require_once('../pages/functions.php');
$id = $_GET['id'];
$regional = $_GET['regional'];
$estado = $regional;

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

$sql_busca_qtde_faltosos_mp =
"SELECT dataref,
    total
   FROM cli_lin_qtde_faltosos
   WHERE INSCRICAO = $id 
   AND  dataref = '$mespassado'
   ORDER BY data_arquivo desc
   LIMIT 1";
 $query_busca_qtde_faltosos_mp = $MySQLi->query($sql_busca_qtde_faltosos_mp) or trigger_error($MySQLi->error, E_USER_ERROR); 
 $row_qtde_faltosos_mp =   $query_busca_qtde_faltosos_mp->fetch_object(); 
 if (!empty($row_qtde_faltosos_mp->total))
 	$qtde_faltosos_mp = $row_qtde_faltosos_mp->total;
 else
 	$qtde_faltosos_mp = 0;

 
 
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
 
 
 $sql_soma_qtde_faltosos_nacional=
 "SELECT AVG(total) as total
 FROM cli_lin_qtde_faltosos xx
 INNER JOIN ap_clinicas A
 ON xx.INSCRICAO =  CASE
 WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
 ELSE substring(a.CNPJ,1,9)
 END

 
 WHERE dataref = '$mespassado'
 and a.ativo = 'Sim' and a.tipoclinica = 'F' ";
 $query_soma_qtde_faltosos_nacional = $MySQLi->query($sql_soma_qtde_faltosos_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
 $row_qtde_faltosos_nacional =   $query_soma_qtde_faltosos_nacional->fetch_object();
 $qtde_faltosos_nacional = $row_qtde_faltosos_nacional->total;



$label = 'Total';
$icon = 'fa-facebook';
$flag = 'invertido';

$data_inclusao_mp = 0;
$total_pac_mes_passado = $_GET['total_pac'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];



echo montaPanel($label, $qtde_faltosos_mp, $total_pac_mes_passado, $qtde_faltosos_regional, $qtde_faltosos_nacional,
		 $total_pac_mes_passado, $icon, $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $data_inclusao_mp, $pacientes_nacional, $pacientes_regional)



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
