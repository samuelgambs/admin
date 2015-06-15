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

$busca_documentacao = 
"SELECT documentacao_mes,
    		max(data_inclusao) as data_inclusao
  FROM cli_documentacao a
  WHERE INSCRICAO = ".$id." and data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_documentacao x  
                                                  WHERE  x.INSCRICAO = a.INSCRICAO limit 1 )";
$query_documentacao = $MySQLi->query($busca_documentacao) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_documentacao = $query_documentacao->fetch_object();
$documentacao_ma = $row_documentacao->documentacao_mes;

$busca_doc_mes_anterior =
"SELECT dataref,
total
FROM cli_lin_documentacao
WHERE INSCRICAO = $id
ORDER BY data_arquivo desc
LIMIT 1,1";
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
$data_inclusao_mp = $row_busca_parcial_documentacao_mp->data_inclusao;

$busca_media_regional_ma =


"SELECT AVG(documentacao_mes) as total, inscricao
FROM cli_documentacao xx
JOIN ap_clinicas a
on xx.INSCRICAO = CASE
                    WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                    ELSE substring(a.CNPJ,1,9)
                  END
WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                            FROM cli_documentacao x
                                           WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' and a.estado ='$estado'";

$query_busca_media_regional_ma =  $MySQLi->query($busca_media_regional_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_regional_ma = $query_busca_media_regional_ma->fetch_object();
$documentacao_regional_ma = $row_busca_media_regional_ma->total;

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

$busca_media_nacional_ma =
"SELECT AVG(TOTAL) as total
FROM cli_lin_documentacao B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
                    WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                    ELSE substring(a.CNPJ,1,9)
                  END
WHERE DATAREF = '$mesatual'
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' ";

$query_busca_media_nacional_ma =  $MySQLi->query($busca_media_nacional_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_nacional_ma = $query_busca_media_nacional_ma->fetch_object();
$documentacao_nacional_ma = $row_busca_media_nacional_ma->total;




$label = 'Documentações';
$icon = 'fa-file-o';
$flag = 'ma';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];

echo montaPanel($label, $total_doc_mes_anterior, $documentacao_ma, $documentacao_regional_ma, $documentacao_nacional_ma, $parcial_documentacao_mp, 
		$icon, $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $data_inclusao_mp, $pacientes_nacional, $pacientes_regional)

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
