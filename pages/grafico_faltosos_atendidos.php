<?php

session_start();

include "functions.php";

session_checker();
require_once('../includes/mysqli.php');

$idclinica = ($_GET['idclinica']);
$busca_nome = "SELECT nomefantasia, cnpj,estado
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
$sql_busca_lin_qtde_faltosos2 =

"SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total, faltosos_agendados, faltosos_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
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

  SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
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

  SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
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

 SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
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
  
  
 SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
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
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
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
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
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
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
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
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
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
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
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
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
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
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
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

$query_busca_lin_qtde_faltosos3 = $MySQLi->query($sql_busca_lin_qtde_faltosos2) or trigger_error($MySQLi->error, E_USER_ERROR);

	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title><?php echo $nomefantasia?> Total de Faltosos Atendidos</title>
 	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

     window.onload = function(){
		           startDrawingFaltososAtendidos();
		       };

		       window.onresize = function(){	
		    	   startDrawingFaltososAtendidos();
		       };	       
		      
    var data_LinFaltAte = [
                        ['Data Referência', 'Faltosos Atendidos','Média Nacional','Média Regional' ],
                                       <?php while ($row_lin_faltosos_atendidos = $query_busca_lin_qtde_faltosos3->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_faltosos_atendidos->dataref; ?>', <?php echo $row_lin_faltosos_atendidos->faltosos_atendidos; ?>, <?php echo round($row_lin_faltosos_atendidos->media_nacional_atendidos,0); ?>,<?php echo round($row_lin_faltosos_atendidos->regional_atendidos,0); ?>,  ],
                                                                     <?php }     ?>
    ];
	startDrawingFaltososAtendidos = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_LinFaltAte);

   var options = {
          title: '<?php echo $nomefantasia?>, Histórico Total de Faltosos Atendidos',
          is3D: true
        };

  var chart = new google.visualization.LineChart(document.getElementById('lin_faltosos_atendidos'));
  chart.draw(data, options);
}
};
     google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = google.visualization.arrayToDataTable(data_LinFaltAte);
        var table = new google.visualization.Table(document.getElementById('tab_fluxo_paciente'));

        table.draw(data, {showRowNumber: true});
      }
    </script>

</head>
<body class="page">
  <div id="lin_faltosos_atendidos"></div>
     <center><div id="tab_fluxo_paciente"></div></center>
</body>
</html>




