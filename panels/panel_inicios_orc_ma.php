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

$busca_orcamentos_inicios =
"SELECT orc_mesatual, ini_mesatual, porc_mesatual, max(data_inclusao) as data_inclusao
  FROM cli_orcamentos_x_inicios a
  WHERE INSCRICAO = ".$id."  and data_inclusao = (SELECT max(x.data_inclusao)
                                                   FROM cli_orcamentos_x_inicios x
                                                  WHERE  x.INSCRICAO = a.INSCRICAO limit 1 )";
$query_orcamentos_inicios = $MySQLi->query($busca_orcamentos_inicios) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_orcamentos_inicios = $query_orcamentos_inicios->fetch_object();
$orc_mesatual = $row_orcamentos_inicios->orc_mesatual;
$ini_mesatual = $row_orcamentos_inicios->ini_mesatual;
$porc_mesatual = $row_orcamentos_inicios->porc_mesatual;



$sql_busca_parcial_inicio_mp =
"SELECT   porc_mesatual, data_inclusao
FROM cli_orcamentos_x_inicios
WHERE INSCRICAO = $id
AND date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)
limit 1";
$query_busca_parcial_inicio_mp = $MySQLi->query($sql_busca_parcial_inicio_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_parcial_inicio_mp = $query_busca_parcial_inicio_mp->fetch_object();
$aproveitamento_parcial_mp = $row_busca_parcial_inicio_mp->porc_mesatual;
$data_inclusao_mp = $row_busca_parcial_inicio_mp->data_inclusao;

$busca_media_regional_ma =
"SELECT AVG(porc_mesatual) as aproveitamento, data_inclusao
FROM cli_orcamentos_x_inicios B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
                    WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                    ELSE substring(a.CNPJ,1,9)
                  END
WHERE b.DATA_INCLUSAO  =  (SELECT max(x.data_inclusao)
                                                   FROM cli_orcamentos_x_inicios x
                                                  WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
                  
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' and a.estado ='$estado'";

$query_busca_media_regional_ma =  $MySQLi->query($busca_media_regional_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_regional_ma = $query_busca_media_regional_ma->fetch_object();
$aproveitamento_regional_ma = $row_busca_media_regional_ma->aproveitamento;


$busca_media_nacional_ma =
"SELECT AVG(porc_mesatual) as aproveitamento, data_inclusao
FROM cli_orcamentos_x_inicios B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
                    WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                    ELSE substring(a.CNPJ,1,9)
                  END
WHERE b.DATA_INCLUSAO  =  (SELECT max(x.data_inclusao)
                                                   FROM cli_orcamentos_x_inicios x
                                                  WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
                  
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' ";

$query_busca_media_nacional_ma =  $MySQLi->query($busca_media_nacional_ma) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_nacional_ma = $query_busca_media_nacional_ma->fetch_object();
$inicio_nacional_ma = $row_busca_media_nacional_ma->aproveitamento;


$label = 'Aproveitamento';
$icon = 'fa-sign-out';
$flag = 'aproveitamento';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];

echo montaPanel($label, $porc_mesatual, $pacientes_regional, $aproveitamento_regional_ma, $aproveitamento_regional_ma, $aproveitamento_parcial_mp, $icon, $flag, $pacientes_nacional, $pacientes_nacional,
		 $data_inclusao_mp, $pacientes_nacional, $pacientes_regional);



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
