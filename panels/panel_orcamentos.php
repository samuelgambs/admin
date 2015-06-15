<?php
error_reporting(E_ALL);

require_once('../includes/mysqli.php');
require_once('../pages/functions.php');
$id = $_GET['id'];
$regional = $_GET['regional'];
$estado = $regional;
$busca_orcamentos_inicios =
"SELECT orc_mespassado, orc_mesatual,max(data_inclusao) as data_inclusao
  FROM cli_orcamentos_x_inicios a
  WHERE INSCRICAO = ".$id."  and data_inclusao = (SELECT max(x.data_inclusao)
                                                   FROM cli_orcamentos_x_inicios x
                                                  WHERE  x.INSCRICAO = a.INSCRICAO limit 1 )";
$query_orcamentos_inicios = $MySQLi->query($busca_orcamentos_inicios) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_orcamentos_inicios = $query_orcamentos_inicios->fetch_object();
$orc_mespassado = $row_orcamentos_inicios->orc_mespassado;
$orc_mesatual = $row_orcamentos_inicios->orc_mesatual;

$busca_media_regional =
    "SELECT AVG(orc_mespassado) as orcamento_regional
      FROM  cli_orcamentos_x_inicios b
INNER JOIN  ap_clinicas a
        ON  b.inscricao =   CASE   
                               WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                               ELSE substring(a.CNPJ,1,9)        
                             END 
 
    WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
     FROM cli_orcamentos_x_inicios x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
      AND a.tipoclinica = 'F' AND a.ativo = 'Sim' and a.Estado = '$regional' ";

$query_busca_media_regional =  $MySQLi->query($busca_media_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_regional = $query_busca_media_regional->fetch_object();
$orcamento_regional = $row_busca_media_regional->orcamento_regional;


$busca_media_nacional =
    "SELECT AVG(orc_mespassado) as orcamento_nacional
      FROM  cli_orcamentos_x_inicios b
INNER JOIN  ap_clinicas a
        ON  b.inscricao =   CASE   
                               WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                               ELSE substring(a.CNPJ,1,9)        
                             END 
 

    WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
     FROM cli_orcamentos_x_inicios x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
      AND a.tipoclinica = 'F' AND a.ativo = 'Sim' ";

$query_busca_media_nacional =  $MySQLi->query($busca_media_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_nacional = $query_busca_media_nacional->fetch_object();
$orcamento_nacional = $row_busca_media_nacional->orcamento_nacional;


$label = 'Orçamentos';
$icon = 'fa-pencil-square-o';
$flag = 'normal';
$parcial_orcamento_mp = $orc_mespassado;
$data_inclusao_mp = 0;
$total_pac_mes_passado = $_GET['total_pac'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];


echo montaPanel($label, $orc_mespassado, $orc_mesatual, $orcamento_regional, $orcamento_nacional, $parcial_orcamento_mp, $icon, 
		$flag,$total_pac_mes_passado,$pacientes_mes_parcial,$data_inclusao_mp,$pacientes_nacional, $pacientes_regional);
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
