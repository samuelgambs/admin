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

$busca_doc_mes_anterior =
"SELECT dataref,
total
FROM cli_lin_documentacao
WHERE INSCRICAO = $id
ORDER BY data_arquivo desc
LIMIT 1";
$query_doc_mes_anterior = $MySQLi->query($busca_doc_mes_anterior) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_doc_mes_anterior = $query_doc_mes_anterior->fetch_object();
$total_doc_mes_anterior = round($row_doc_mes_anterior->total);

$sql_busca_parcial_documentacao_mp =
"SELECT   documentacao_mes, data_inclusao
FROM cli_documentacao
WHERE INSCRICAO = $id
AND date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)
limit 1";
$query_busca_parcial_documentacao_mp = $MySQLi->query($sql_busca_parcial_documentacao_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_parcial_documentacao_mp = $query_busca_parcial_documentacao_mp->fetch_object();
$parcial_documentacao_mp = $row_busca_parcial_documentacao_mp->documentacao_mes;

$busca_media_regional_mp =
"SELECT AVG(TOTAL) as total
FROM cli_lin_documentacao B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
                    WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                    ELSE substring(a.CNPJ,1,9)
                  END
WHERE DATAREF = '$mespassado'
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' and a.estado ='$estado'";

$query_busca_media_regional_mp =  $MySQLi->query($busca_media_regional_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_regional_mp = $query_busca_media_regional_mp->fetch_object();
$documentacao_regional_mp = $row_busca_media_regional_mp->total;

$busca_media_nacional_mp =
"SELECT AVG(TOTAL) as total
FROM cli_lin_documentacao B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE DATAREF = '$mespassado'
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' ";

$query_busca_media_nacional_mp =  $MySQLi->query($busca_media_nacional_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_nacional_mp = $query_busca_media_nacional_mp->fetch_object();
$documentacao_nacional_mp = $row_busca_media_nacional_mp->total;



$label = 'Documentações';
$icon = 'fa-file-o';
$flag = 'normal';
$parcial_documentacao_mp = $total_doc_mes_anterior;
$documentacao_ma = $total_doc_mes_anterior;
$data_inclusao_mp = 0;
$total_pac_mes_passado = $_GET['total_pac'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];


echo montaPanel($label, $total_doc_mes_anterior, $documentacao_ma, $documentacao_regional_mp, $documentacao_nacional_mp, $parcial_documentacao_mp, $icon, $flag, $total_pac_mes_passado,
 $pacientes_mes_parcial, $data_inclusao_mp, $pacientes_nacional, $pacientes_regional)

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
