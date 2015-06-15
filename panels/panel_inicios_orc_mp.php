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


$busca_orcamentos_inicios =
"SELECT porc_mespassado, max(data_inclusao) as data_inclusao
  FROM cli_orcamentos_x_inicios a
  WHERE INSCRICAO = ".$id."  and data_inclusao = (SELECT max(x.data_inclusao)
                                                   FROM cli_orcamentos_x_inicios x
                                                  WHERE  x.INSCRICAO = a.INSCRICAO limit 1 )";
$query_orcamentos_inicios = $MySQLi->query($busca_orcamentos_inicios) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_orcamentos_inicios = $query_orcamentos_inicios->fetch_object();
$porc_mespassado = $row_orcamentos_inicios->porc_mespassado;



$busca_media_regional_mp =
"SELECT AVG(porc_mespassado) as porc_mespassado
FROM cli_orcamentos_x_inicios B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
                    WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                    ELSE substring(a.CNPJ,1,9)
                  END
WHERE DATA_INCLUSAO = (SELECT max(x.data_inclusao)
                                                   FROM cli_orcamentos_x_inicios x
                                                  WHERE  x.INSCRICAO = B.INSCRICAO limit 1 )
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' and a.estado ='$estado'";

$query_busca_media_regional_mp =  $MySQLi->query($busca_media_regional_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_regional_mp = $query_busca_media_regional_mp->fetch_object();
$porc_regional_mp = $row_busca_media_regional_mp->porc_mespassado;

$busca_media_nacional_mp =
"SELECT AVG(porc_mespassado) as porc_mespassado
FROM cli_orcamentos_x_inicios B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
                    WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                    ELSE substring(a.CNPJ,1,9)
                  END
WHERE DATA_INCLUSAO = (SELECT max(x.data_inclusao)
                                                   FROM cli_orcamentos_x_inicios x
                                                  WHERE  x.INSCRICAO = B.INSCRICAO limit 1 )
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' ";

$query_busca_media_nacional_mp =  $MySQLi->query($busca_media_nacional_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_nacional_mp = $query_busca_media_nacional_mp->fetch_object();
$porc_nacional_mp = $row_busca_media_nacional_mp->porc_mespassado;



$label = 'Aproveitamento';
$icon = 'fa-sign-out';
$flag = 'aproveitamento-mp';

$var_parcial_mp = $_GET['total_pac'];
$data_inclusao_mp = $_GET['total_pac'];
$total_pac_mes_passado = $_GET['media_pac_nacional'];
$pacientes_mes_parcial = $_GET['media_pac_regional'];



echo montaPanel($label, $porc_mespassado, $var_parcial_mp, $porc_regional_mp, $porc_nacional_mp, $var_parcial_mp, $icon, $flag, $total_pac_mes_passado, $pacientes_mes_parcial, 
		$data_inclusao_mp, $total_pac_mes_passado, $pacientes_mes_parcial)



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
