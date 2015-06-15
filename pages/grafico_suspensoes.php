<?php

session_start();

include "functions.php";

session_checker();
require_once('../includes/mysqli.php');

$idclinica = ($_GET['idclinica']);
$busca_nome = "SELECT nomefantasia, cnpj, estado
FROM ap_clinicas
WHERE idclinica = '$idclinica'
AND tipoclinica = 'F'";
$query_busca_nome = $MySQLi->query($busca_nome) OR trigger_error($MySQLi->error, E_USER_ERROR);
$row_busca_nome = $query_busca_nome->fetch_object();
$nomefantasia =  $row_busca_nome->nomefantasia;
$estado =  $row_busca_nome->estado;

$id = $row_busca_nome->cnpj;
if (strlen($id) > 11 )
$id = substr($id,0,8);
else
$id = substr($id,0,9);

$sql_busca_lin_suspensoes =
"SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";

$query_busca_lin_suspensoes =  $MySQLi->query($sql_busca_lin_suspensoes) or trigger_error($MySQLi->error, E_USER_ERROR);
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title><?php echo $nomefantasia?> Suspensôes</title>
 	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

     window.onload = function(){
        		     
		           startDrawingSusp();
		       };

			   	window.onresize = function(){	
		       	           startDrawingSusp();
	       };	       
		      
  var data_LinSuspensoes = [
                            ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                 <?php while ($row_lin_suspensoes= $query_busca_lin_suspensoes->fetch_object()) {
                                ?>
                                ['<?php echo $row_lin_suspensoes->dataref; ?>', <?php echo $row_lin_suspensoes->quantidade; ?>,<?php echo round($row_lin_suspensoes->media_regional,0); ?>, <?php echo round($row_lin_suspensoes->media_nacional,0); ?>  ],
                                                             <?php }     ?>
];
		       
		       startDrawingSusp = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinSuspensoes);

        var options = {
          title: 'Suspensões',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
          
        };

        var chart = new google.visualization.LineChart(document.getElementById('lin_suspensoes'));
        chart.draw(data, options);
      }
  };
   function drawTable() {
          var data = google.visualization.arrayToDataTable(data_LinSuspensoes);
       

        var table = new google.visualization.Table(document.getElementById('tab_fluxo_paciente'));

        table.draw(data, {showRowNumber: true});
      }
    </script>

</head>
<body class="page">
  <div id="lin_suspensoes"></div>
       <center><div id="tab_fluxo_paciente"></div></center>

</body>
</html>




