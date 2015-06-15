<?php
require_once('mysqli.php');



if (!empty($_GET['name'])) 
{
   $busca_idclinica = "    SELECT CNPJ
                            FROM ap_clinicas
                            WHERE nomefantasia LIKE '".$_GET['name']."'
                            AND tipoclinica = 'F'";

  $query_busca_idclinica = $MySQLi->query($busca_idclinica) OR trigger_error($MySQLi->error, E_USER_ERROR);
  $row = $query_busca_idclinica->fetch_object();
  $id = $row->CNPJ;
  $id = substr($id,0,8); 
  $nomefantasia = $_GET['name'];
}

else {
  $idclinica = ($_GET['idclinica']);
  $busca_nome = "SELECT nomefantasia, cnpj
                  FROM ap_clinicas
                 WHERE idclinica = '$idclinica' 
                  AND tipoclinica = 'F'";
  $query_busca_nome = $MySQLi->query($busca_nome) OR trigger_error($MySQLi->error, E_USER_ERROR);  
  $row_busca_nome = $query_busca_nome->fetch_object();  
  $nomefantasia =  $row_busca_nome->nomefantasia; 
  $id = $row_busca_nome->cnpj;
  if (strlen($id) > 11 )
 	 $id = substr($id,0,8);  
  else 
  	$id = substr($id,0,9);
}

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


$busca_regional = "SELECT estado
                  FROM ap_clinicas
                 WHERE idclinica = '$idclinica' ";
$query_regional = $MySQLi->query($busca_regional) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_regional = $query_regional->fetch_object();
$regional =  $row_busca_regional->estado;
$estado = $regional;

$busca_numero_de_regionais_por_estado = 
"SELECT idclinica
  FROM ap_clinicas
  WHERE estado = '$estado'
   AND ativo = 'Sim'
   AND tipoclinica = 'F' ";
$query_numero_de_regionais_por_estado =  $MySQLi->query($busca_numero_de_regionais_por_estado) OR trigger_error($MySQLi->error, E_USER_ERROR); 
$num_rows_clinicas_regional = mysqli_num_rows($query_numero_de_regionais_por_estado);


$busca_numero_de_regionais_nacional =
"SELECT idclinica
FROM ap_clinicas
WHERE ativo = 'Sim'
AND tipoclinica = 'F' ";
$query_numero_de_regionais_nacional =  $MySQLi->query($busca_numero_de_regionais_nacional) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num_rows_clinicas_nacional = mysqli_num_rows($query_numero_de_regionais_nacional);




$busca_media_regional_mp =
"SELECT  AVG(total_pac_mes_passado) AS total_pac_mes_passado
      FROM  ap_clinicas a
       
 INNER JOIN (SELECT inscricao, total_pac_mes_passado, data_inclusao
                            FROM cli_fluxo_paciente  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                                         FROM cli_fluxo_paciente x
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Q ON Q.INSCRICAO = CASE
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                                ELSE substring(a.CNPJ,1,9)
                                                                                                                                              END

    WHERE q.data_inclusao = (SELECT max(x.data_inclusao)
						     FROM cli_fluxo_paciente x
						    WHERE  x.INSCRICAO = q.INSCRICAO limit 1 )
   AND a.tipoclinica = 'F' and a.estado ='$estado' and a.ativo ='sim' ";

$query_busca_media_regional =  $MySQLi->query($busca_media_regional_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_regional = $query_busca_media_regional->fetch_object();
$pacientes_regional_mp = $row_busca_media_regional->total_pac_mes_passado;


$busca_media_nacional_mp =
"SELECT  AVG(total_pac_mes_passado) AS total_pac_mes_passado
      FROM  ap_clinicas a
       
 INNER JOIN (SELECT inscricao, total_pac_mes_passado, data_inclusao
                            FROM cli_fluxo_paciente  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                                         FROM cli_fluxo_paciente x
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Q ON Q.INSCRICAO = CASE
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                                ELSE substring(a.CNPJ,1,9)
                                                                                                                                              END

    WHERE q.data_inclusao = (SELECT max(x.data_inclusao)
						     FROM cli_fluxo_paciente x
						    WHERE  x.INSCRICAO = q.INSCRICAO limit 1 )
   AND a.tipoclinica = 'F' and a.ativo ='sim'  ";

$query_busca_media_nacional =  $MySQLi->query($busca_media_nacional_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_media_nacional = $query_busca_media_nacional->fetch_object();
$pacientes_nacional_mp = $row_busca_media_nacional->total_pac_mes_passado;



$busca_fluxo_paciente_mp =
"SELECT total_pac_mes_passado,
    		
    		max(data_inclusao) as data_inclusao
  FROM cli_fluxo_paciente a
 WHERE INSCRICAO = ".$id." and data_inclusao = (SELECT max(x.data_inclusao)
                                                   FROM cli_fluxo_paciente x
                                                  WHERE  x.INSCRICAO = a.INSCRICAO limit 1 )";
$query_fluxo_paciente = $MySQLi->query($busca_fluxo_paciente_mp) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_fluxo_paciente = $query_fluxo_paciente->fetch_object();
$total_pac_mp = $row_fluxo_paciente->total_pac_mes_passado;


$busca_lin_fluxo_paciente =
"SELECT dataref,
total
FROM cli_lin_fluxo_paciente
WHERE INSCRICAO = $id
ORDER BY data_arquivo desc
LIMIT 1";
$query_busca_lin_fluxo_paciente = $MySQLi->query($busca_lin_fluxo_paciente) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_lin_fluxo_paciente = $query_busca_lin_fluxo_paciente->fetch_object();
 $pacientes_ma = $row_busca_lin_fluxo_paciente->total;

$busca_media_pac_ma_nacional = 
"SELECT AVG(TOTAL) as total
FROM cli_lin_fluxo_paciente B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
                   WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                   ELSE substring(a.CNPJ,1,9)
                 END
WHERE b.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_fluxo_paciente x
                                               WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' ";
$query_media_pac_ma_nacional =  $MySQLi->query($busca_media_pac_ma_nacional) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_pac_ma_nacional = $query_media_pac_ma_nacional->fetch_object();
$pacientes_nacional_ma = $row_media_pac_ma_nacional->total;

$busca_media_pac_ma_regional =
"SELECT AVG(TOTAL) as total
FROM cli_lin_fluxo_paciente B
JOIN ap_clinicas a
on b.INSCRICAO = CASE
                   WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                   ELSE substring(a.CNPJ,1,9)
                 END
WHERE b.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_fluxo_paciente x
                                               WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
AND A.Ativo = 'Sim' and a.tipoclinica = 'f' and a.estado ='$estado'";
$query_media_pac_ma_regional =  $MySQLi->query($busca_media_pac_ma_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_pac_ma_regional = $query_media_pac_ma_regional->fetch_object();
$pacientes_regional_ma = $row_media_pac_ma_regional->total;

$busca_data_atualizacao =
"SELECT max(data_inclusao) as data_inclusao
		FROM cli_orcamento
		WHERE INSCRICAO = $id";
$query_data_atualizacao =  $MySQLi->query($busca_data_atualizacao) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_data_atualizacao = $query_data_atualizacao->fetch_object();
$data_atualizacao = $row_data_atualizacao->data_inclusao;


$busca_lin_negociacao =
"SELECT dataref,
total_a_receber,
total_em_atraso,
total_pago
FROM cli_lin_negociacao
WHERE INSCRICAO = $id
ORDER BY data_arquivo desc
LIMIT 12";
$query_lin_negociacao = $MySQLi->query($busca_lin_negociacao) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_negociacao = $query_lin_negociacao->fetch_object();
if (isset($row_negociacao->total_a_receber)) $total_a_receber = $row_negociacao->total_a_receber;
else $total_a_receber = 0;
if (isset($row_negociacao->total_em_atraso)) $total_em_atraso = $row_negociacao->total_em_atraso;
else $total_em_atraso = 0;
if (isset($row_negociacao->total_pago)) $total_pago = $row_negociacao->total_pago;
else $total_pago = 0;

$busca_lin_negociacao2 =
"SELECT dataref,
total_a_receber,total_em_atraso,
total_pago,
data_arquivo
FROM cli_lin_negociacao
WHERE INSCRICAO = $id
AND date(data_arquivo) BETWEEN ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1)
AND date(now())
ORDER BY data_arquivo";
$query_lin_negociacao2 = $MySQLi->query($busca_lin_negociacao2) or trigger_error($MySQLi->error, E_USER_ERROR);



$busca_negociacao_mp =
"SELECT DATA_INCLUSAO,
total_a_receber,
total_em_atraso,
total_pago
FROM cli_lin_negociacao xx
WHERE INSCRICAO = $id
AND dataref = '$mespassado'";

$query_negociacao_mp = $MySQLi->query($busca_negociacao_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_negociacao_mp = $query_negociacao_mp->fetch_object();
if (!empty($row_negociacao_mp->total_a_receber)) $total_a_receber_mp = $row_negociacao_mp->total_a_receber;
else $total_a_receber_mp = 0;
if (!empty($row_negociacao_mp->total_em_atraso)) $total_em_atraso_mp = $row_negociacao_mp->total_em_atraso;
else $total_em_atraso_mp = 0;
if (!empty($row_negociacao_mp->total_pago)) $total_pago_mp = $row_negociacao_mp->total_pago;
else $total_pago_mp = 0;
		
		
		
		
